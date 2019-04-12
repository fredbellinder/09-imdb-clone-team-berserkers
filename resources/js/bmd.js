const commentToDelete = $('.delete-comment');
function deleteComment(event) {
    event.preventDefault();
    $.ajax(
        {
            url: `/comments/${event.target[2].value}`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(() => {
            $(this).closest('.card').remove();
        });
}
commentToDelete.on('submit', deleteComment)


const reviewToDelete = $('.delete-review');
function deleteReview(event) {
    event.preventDefault();
    console.log(event.target[2].value);

    $.ajax(
        {
            url: `/reviews/${event.target[2].value}`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(() => {
            $(this).closest('.container').remove();
        });
}
reviewToDelete.on('submit', deleteReview)