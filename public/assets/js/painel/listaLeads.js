function removerLead(id){
    $.ajax({
        url: `${window.location.href}/${id}`,
        type: 'DELETE',
        success: (response) => {
            window.location.reload();
        },
        error: (e) => {
            console.error(e)
        }
    });
}
