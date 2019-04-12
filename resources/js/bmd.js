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
            $(this).closest('.container-comment').remove();
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
            $(this).closest('.container-review').remove();
        });
}
reviewToDelete.on('submit', deleteReview)

const editReviewForm = $('.edit-review');
function editReview(event) {
    event.preventDefault();
    const review_id = (event.target[1].value);
    const reviewInfo = $(this).closest('.container-review');
    const editReview = $(`.edit-review-container-${review_id}`);
    editReview.show();
    reviewInfo.hide();

    $(`.edit-submit-${review_id}`).on('submit', function (event, reviewInfo) {
        event.preventDefault();
        $(`.edit-review-container-${review_id}`).hide();
        editReview.hide();
        reviewInfo.show();

    });
    $(`.edit-review-cancel`).on('click', function (event) {
        event.preventDefault();
        $(`.edit-review-container-${review_id}`).hide();
        reviewInfo.show();
    });
}
editReviewForm.on("submit", editReview);