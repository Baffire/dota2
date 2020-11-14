$(() => {
  $('body').on('click', '.comment__reply', function (e) {
    e.preventDefault();
    const openingForm = $(this).closest('.comment-wrap').children('.reply-form');
    openingForm.slideToggle();
    $('.reply-form').not(openingForm).not($('.reply-form').last()).slideUp();
  });

  $('body').on('click', '.comment__like', function (e) {
    e.preventDefault();
    const comment = $(this).closest('.comment');
    const commentId = comment.attr('data-id');
    $.ajax({
      type: "POST",
      url: `/like/${commentId}`,
      data: {
        '_token': CSRF_TOKEN
      },
      dataType: "json",
      success: (response) => {
        // alert('поставил лайк');
        const rating = response.rating;
        comment.find('.comment__score').text(rating);
      }
    })
  });

  $('body').on('click', '.comment__dislike', function (e) {
    e.preventDefault();
    const comment = $(this).closest('.comment');
    const commentId = comment.attr('data-id');
    $.ajax({
      type: "POST",
      url: `/dislike/${commentId}`,
      data: {
        '_token': CSRF_TOKEN
      },
      dataType: "json",
      success: (response) => {
        // alert('поставил дизлайк');
        const rating = response.rating;
        comment.find('.comment__score').text(rating);
      }
    })
  });

  $('body').on('submit', '.reply-form', function (e) {
    e.preventDefault();
    const postId = $('.post').attr('data-id');
    const parentComment = $(this).closest('.comment-wrap').find('.comment');
    let parentCommentId = null;
    if (parentComment.length) {
      parentCommentId = parentComment.attr('data-id');
    }

    let formParams = $(this).serializeArray();
    formParams.push({name:'parent_id', value:parentCommentId});

    let form = this;
      
    $.ajax({
      type: "POST",
      url: `/comment/${postId}`,
      data: $.param(formParams),
      dataType: "json",
      success: (response) => {
        if (response.status) {
          $('.comments').html(response.comments);
          form.reset();
        } else {
          alert(response.error);
        }
      }
    });
  });

  $('.sort-item').on('click', function(e) {
    e.preventDefault();
    const sortItem = $(this);
    if (!sortItem.is('.active')) {
      const postId = $('.post').attr('data-id');
      const sort = sortItem.attr('data-sort');
      let formParams = [{name: 'sort', value: sort}];
      $.ajax({
        type: "GET",
        url: `/get_comments/${postId}`,
        data: $.param(formParams),
        dataType: "json",
        success: (response) => {
          $('.comments').html(response.comments);
          $('.sort-item.active').removeClass('active');
          sortItem.addClass('active');
        }
      });
    }
  });

});