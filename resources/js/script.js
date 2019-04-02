$(() => {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })


    $('.form-delete').submit((e) => {
        e.preventDefault();
        let href = $(e.currentTarget).attr('action')
        if (confirm('Vraiment supprimer ?')){
            $.ajax({
                url: href,
                type: 'DELETE'
            })
            .done((data) => {
                document.getElementById("post-" + data.id).remove()
            })
            .fail(() => {
                alert("L'article n'a pas pu être supprimé")
            })
        }

    })
})