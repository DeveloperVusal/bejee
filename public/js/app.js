const malert = (el, message, type, addmsg) => {
    const wrapper = document.createElement('div')
    wrapper.id = Date.now()
    wrapper.innerHTML = [
      `<div class="alert alert-${type} alert-dismissible" role="alert">`,
      `   <div>${message}</div>`,
      '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
      `${(addmsg)?'   <hr><p class="alert-font-small mb-0">'+addmsg+'</p>':''}`,
      '</div>'
    ].join('')
    
    el.append(wrapper)

    if (el.childElementCount > 1) el.firstChild.remove()
}

function onSubmitTaskSave(form) {
    var data = {
        name: form.name?.value ?? '',
        email: form.email?.value ?? '',
        text: form.text.value,
    }

    if (form.taskid != undefined) {
        data['id'] = Number(form.taskid.value)
        data['is_done'] = form.is_done.checked
    }

    if (form.user_id != undefined) {
        data['user_id'] = form.user_id.value
    }

    axios.put('/api/task-save', data)
      .then(function (response) {
        const resp = response.data
        let status = resp.status.toLowerCase()

        if (status == 'error') status = 'danger'

        const alertEl = form.children.liveAlertPlaceholder
        malert(alertEl, resp.message, status, (status == 'success')?'Обновление страницы через 5 секунд':'')

        if (resp.code === 0) {
            if (form.taskid == undefined) {
                form.name.value = ''
                form.email.value = ''
                form.text.value = ''
            }
            setTimeout(function() {
                window.location.reload()
            }, 5000)
        }
      })
      .catch(function (error) {
        console.log(error)
        if (error?.response?.status == 401) {
            const conf = confirm('Необходимо авторизоваться')

            if (conf) window.location.href = '/auth'
        }
      })
}

function onSubmitAuth(form) {
    axios.post('/api/login', {
        login: form.login.value,
        password: form.password.value,
    })
      .then(function (response) {
        const resp = response.data

        if (resp.code === 0) {
            window.location.href = '/'
        } else {
            alert(resp.message)
        }
      })
      .catch(function (error) {
        console.log(error)
      })
}

function handleRoute(key, val, opt) {
    const href = new URL(window.location.href)

    if (opt == 'set') href.searchParams.set(key, val)
    else if (opt == 'del') href.searchParams.delete(key)
    
    window.location.href = href.toString()
}

document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('#selects-sorts select')
    
    if (selects && selects.length) {
        for (let i = 0; i < selects.length; i++) {
            selects[i].addEventListener('change', function(e) {
                if (selects[i].value.length) {
                    handleRoute(selects[i].name, selects[i].value, 'set')
                } else {
                    handleRoute(selects[i].name, selects[i].value, 'del')
                }
            })
        }
    }
})