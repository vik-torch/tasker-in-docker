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
            'error': () => alert('Не удалось выполнить операцию.')
        }, "json");
    }

    handleAuthResponse(data)
    {
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

class User
{
    isAuth()
    {
        let auth_id = this.getCookie('auth_id');
        return auth_id !== undefined;
    }

    getCookie(name) {
        let matches = document.cookie.match(new RegExp(
          "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
      }
}

$(() => {
    auth_page = new AuthPage();
    user = new User();
});