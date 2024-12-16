let auth_page;

class AuthPage
{
    constructor()
    {
        this.$authForm = new AuthForm();

        this.bindEvents();
    }

    bindEvents()
    {
        this.$authForm.$place.on('submit', this.checkAuth.bind(this));
    }

    checkAuth(event)
    {
        event.preventDefault();

        let formData = new FormData();
        formData.append('login', this.$authForm.$login.val());
        formData.append('password', this.$authForm.$password.val());

        $.post({
            'url': '/login/auth',
            'headers': {'X-Requested-With': 'XMLHttpRequest'},
            'cache': false,
            'data': formData,
            'contentType': false,
            'processData': false,
            'success': this.handleAuthResponse.bind(this),
            'error': (data) => alert('Не удалось выполнить операцию.')
        }, "json");
    }

    handleAuthResponse(data)
    {
        // data = JSON.parse(data);
        if(data.status == 200) {
            this.buildTasks(data.data);
        } else if (data.status == 300) {
            window.location.href = '/tasks';
        } else {
            alert(data.message ?? 'Не удалось авторизроваться. Проверьте введенные данные.');
        }
    }
}

class AuthForm
{
    constructor()
    {
        this.$place = $('#auth_form');
        this.$login = this.$place.find('#login');
        this.$password = this.$place.find('#password');
    }

    isValid()
    {
        if (this.$login.val() == '' || this.$password.val() == '') {
            return false;
        }
        return true;
    }
}

$(() => auth_page = new AuthPage())