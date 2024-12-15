let page;

class Page
{
    constructor()
    {
        this.$taskForm = $('#task_form');
        this.tasks = new Tasks();

        this.init();
        this.bindEvents();
    }

    bindEvents()
    {
        $(document).on('update-task', this.updateTask.bind(this));
        $(document).on('show-tasks', this.showTasks.bind(this));
    }

    init()
    {
        this.$taskForm.on('submit', this.createTask.bind(this));
        this.showTasks.call(this);
    }

    showTasks(event, page_num = 1)
    {
        this.clearTasksContent();
        this.getTasksCollection(page_num);
    }

    createTask(event)
    {
        event.preventDefault();
        
        let formData = new FormData();
        formData.append('email', this.$taskForm.find('#email').val());
        formData.append('name', this.$taskForm.find('#name').val());
        formData.append('text',  this.$taskForm.find('#text').val());
        
        $.post({
              'url': '/tasks/store',
              'headers': {'X-Requested-With': 'XMLHttpRequest'},
              'cache': false,
              'data': formData,
              'contentType': false,
              'processData': false,
              'success': this.handleCreateTaskResponse.bind(this),
              'error': () => alert('Не удалось создать комментарий.')
        }, "json");
    }

    handleCreateTaskResponse(data)
    {
        data = JSON.parse(data);
        if (data.status == 201) {
            this.showTasks.call(this);
            alert('Задача успешно добавлена!');
        } else {
            alert('Не удалось создать задачу.');
        }
    }

    getTasksCollection(page_num)
    {
        let sort_params = this.tasks.getSortParams();

        let formData = new FormData();
        formData.append('page', page_num);
        
        if (sort_params) {
            formData.append('sort_by', sort_params.target_field);
            formData.append('order', sort_params.sort_method);
        }

        $.post({
            'url': '/tasks',
            'headers': {'X-Requested-With': 'XMLHttpRequest'},
            'cache': false,
            'data': formData,
            'contentType': false,
            'processData': false,
            'success': this.handleTasksCollection.bind(this),
            'error': () => alert(`Не удалось получить список задач.`)
        }, "json");
    }

    handleTasksCollection(data)
    {
        // data = JSON.parse(data);
        if(data.status == 200) {
            this.buildTasks(data.data);
        } else {
            alert('Странный вид ответа');
        }
    }

    buildTasks(data)
    {
        this.tasks.build(data);
    }
    
    updateTask(event, task)
    {
        let formData = new FormData();
        formData.append('id', task.id);
        if (!task.text && !task.status) {
            alert('Ошибка обновления задачи');
            return;
        }

        task.text ?? formData.append('text', task.text);
        task.status ??formData.append('status', task.status);

        $.post({
            'url': '/tasks/update/',
            'headers': {'X-Requested-With': 'XMLHttpRequest'},
            'cache': false,
            'data': formData,
            'contentType': false,
            'processData': false,
            'success': this.update.bind(this),
            'error': (data) => alert(`Не удалось удалить комментарий.`)
        }, "json");
    }

    update(event, data)
    {
        this.showTasks.call(this);
    }

    clearTasksContent()
    {
        this.tasks.clear();
    }
}

class Tasks
{
    constructor()
    {
        this.elements = [];
        this.pagination = new Pagination();
        this.sort = new SortTasks();

        this.$empty_list_msg = $('.empty_list_msg');

        this.$place = $('#tasks_list');
    }

    clear()
    {
        this.$place.empty();
    }

    build(data)
    {
        this.pagination.update(data.page_num, data.total_count);

        if(data.pageCount == 0) {
            this.hide();
            return;
        }

        data.tasks.forEach(element => {
            let task = new Task(element);
            this.$place.append(task.getContent());
        });

        this.show();

        $('#tasks_list .update_btn').one('click', this.updateTask.bind(this));
    }

    updateTask(event)
    {
        let task_id = $(event.target).closest('.card').attr('data-card-id')
        let text = $(event.target).closest('.card').find('.text').text();
        let status = $(event.target).closest('.card').find('.status').text();

        let task = {
            id: task_id,
            text: text,
            status: status
        };

        $(document).trigger('update-task', task);
    }

    getSortParams()
    {
        return this.sort.getParams();
    }

    show()
    {
        this.sort.show();
        this.hideEmptyListMessage();
    }

    hide()
    {
        this.sort.hide();
        this.showEmptyListMessage();
    }

    showEmptyListMessage()
    {
        this.$empty_list_msg.removeClass('d-none');
    }

    hideEmptyListMessage()
    {
        this.$empty_list_msg.addClass('d-none');
    }
}

class Task
{
    constructor(data)
    {
        this.card_id = data.id;
        this.text = data.text;
        this.status = data.status;
        this.user_name = data.user_name;
        this.email = data.user_email;
        
        this.$body = $('#card_pattern .task-card').clone();

        this.buildBody();
    }

    getContent()
    {
        return this.$body;
    }

    buildBody()
    {
        this.$body.find('.card').attr('data-card-id', this.card_id);
        this.$body.find('.text').text(this.text);
        this.$body.find('.user_name').text(this.user_name);
        this.$body.find('.email').text(this.email);

        switch (this.status) {
            case 'DONE':
                this.$body.find('.status').attr('checked','checked');
                break;
            case 'NEW':
                this.$body.find('.status').removeAttr('checked');
                break;
        }
    }
}

class Pagination
{
    constructor()
    {
        this.config = {place: '#task_pagination'}
        this.total = 1;
        this.current_page = 1;
        this.$place = $(this.config.place);
    }

    update(current_page, total)
    {
        this.current_page = current_page;
        this.total = total;
        this.display();
    }
    
    display()
    {
        if(this.total > 1) {
            this.show();
        } else {
            this.hide();
        }
    }

    show()
    {
        this.$place.removeClass('d-none');
        this.clear();
        
        if(this.current_page > 1) {
            this.$place.find('ul')
                .append(`<li class="page-item">
                            <a class="page-link" href="/tasks?page=${this.current_page - 1}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>`)
        }

        if(this.current_page == 1) {
            for(let idx = 1; idx <= this.total && idx <= 3; idx++) {
                this.$place.find('ul')
                    .append(`<li class="page-item ${idx == this.current_page ? 'active' : ''}">
                                <a class="page-link" href="/tasks?page=${idx}">${idx}</a>
                            </li>`)
            }
        } else if (this.current_page == this.total && this.total != 2) {
            for(let idx = 1; idx <= this.total && idx <= 3; idx++) {
                this.$place.find('ul')
                    .append(`<li class="page-item ${idx == this.total ? 'active' : ''}">
                                <a class="page-link" href="/tasks?page=${idx}">${idx}</a>
                            </li>`)
            }
        } else {
            let start = this.current_page - 1;
            let limit = start + 2;
            for(let idx = start; idx <= this.total && idx <= limit; idx++) {
                this.$place.find('ul')
                    .append(`<li class="page-item ${idx == this.current_page ? 'active' : ''}">
                                <a class="page-link" href="/tasks?page=${idx}">${idx}</a>
                            </li>`)
            }
        }

        if(this.current_page < this.total) {
            this.$place.find('ul')
                .append(`<li class="page-item">
                            <a class="page-link" href="/tasks?page=${this.current_page + 1}" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>`)

        }

        this.setEventPaginationChange()
    }

    clear()
    {
        this.$place.find('ul').empty();
    }

    setEventPaginationChange()
    {
        $(`${this.config.place} li`).on('click', this.paginationChange.bind(this))
    }

    paginationChange(event)
    {
        event.preventDefault();
        let href = $(event.target).attr('href');
        let page_num = href.match(/\d+/g);

        $(document).trigger('show-tasks', page_num);
    }

    hide()
    {
        this.$place.addClass('d-none');
    }
}

class SortTasks
{
    constructor()
    {
        this.config = {place: '#tasks_sort'};

        this.$place = $(this.config.place);
        this.active_field_selector = `${this.config.place} a.active`;

        this.target_field = $(this.active_field_selector).attr('data-name');
        this.sort_method  = $(this.active_field_selector).attr('data-sort');

        $(`${this.config.place} a`).on('click', this.chooseSortType.bind(this))
    }

    chooseSortType(event)
    {
        $(this.active_field_selector).removeClass('active');

        let $target = $(event.target);
        $target.addClass('active');
        
        this.target_field = $target.attr('data-name');
        this.sort_method = $target.attr('data-sort');

        $(document).trigger('show-tasks');
    }

    getParams()
    {
        if (!this.target_field) {
            return null;
        }

        return {
            target_field: this.target_field,
            sort_method: this.sort_method
        }
    }

    hide()
    {
        this.$place.addClass('d-none');
    }

    show()
    {
        this.$place.removeClass('d-none');
    }
}


$(() => page = new Page())