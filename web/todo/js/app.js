const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const alert = (message, type, addmsg) => {
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
      `<div class="alert alert-${type} alert-dismissible" role="alert">`,
      `   <div>${message}</div>`,
      '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
      `${(addmsg)?'   <hr><p class="alert-font-small mb-0">'+addmsg+'</p>':''}`,
      '</div>'
    ].join('')
  
    alertPlaceholder.append(wrapper)
}

function onSubmitTaskSave(form) {
    var data = {
        name: form.name.value,
        email: form.email.value,
        text: form.text.value,
    }

    if (form.taskid != undefined) {
        data['id'] = form.taskid.value
        data['is_done'] = form.is_done.value
    }

    if (form.user_id != undefined) {
        data['user_id'] = form.user_id.value
    }

    axios.put('/api/task-save', data)
      .then(function (response) {
        const resp = response.data
        let status = resp.status.toLowerCase()

        if (status == 'error') status = 'danger'

        if (resp.code === 0) {
            alert(resp.message, status, 'Обновление страницы через 5 секунд')
            setTimeout(function() {
                window.location.reload()
            }, 5000)
        }
      })
      .catch(function (error) {
        console.log(error)
      })
}