$(function() {
/**
 * mark a LIKE onto creator's post
 * @param {object} likeId
 * @param {number} initialCount
 * @param {number} insertedNum
 * @return {void}
 */
  const likes = $('[data-like]');
  for (i = 0; i < likes.length; i++) {
    likes[i].addEventListener('click', function() {
    // eslint-disable-next-line no-invalid-this
      const self = $(this);
      const likeId = self.data('like');
      const initialCount = $(`#count_${likeId}`).data('count');
      let insertedNum = $(`#count_${likeId}`).data('inserted');
      self.prop('disabled', true);
      // jsのajax使う前に記述
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
      });
      $.ajax({
        type: 'POST', // GETかPOSTか
        url: 'like/' + likeId, // url+ファイル名 .htmlは省略可
        dataType: 'json',
        timeout: 15000,
      }).done(function(res) {
        const title = res['title']; // object
        const img = res['img']; // success

        // １回押していいねしたものを取り消す（unlike）
        if ( insertedNum - 1 === initialCount & $(`#btn_${likeId}`).html().indexOf(' いいね済み ') !== -1) {
          insertedNum = initialCount;
          $(`#btn_${likeId}`).html(`
                  <i class="fas fa-heart"></i> いいね <span id="count_${likeId}"
                  data-inserted="${insertedNum}" data-count="${initialCount}">${insertedNum}</span>
              `);
          $(`#list_${likeId}`).remove();
        } else if (insertedNum === initialCount & $(`#btn_${likeId}`).html().indexOf(' いいね ') !== -1) {
          // 取り消した操作を再度戻す（like）
          insertedNum = initialCount + 1;
          $(`#btn_${likeId}`).html(`
                  <i class="fas fa-heart"></i> いいね済み <span id="count_${likeId}"
                  data-inserted="${insertedNum}" data-count="${initialCount}">${insertedNum}</span>
              `);
          document.getElementById('like-list').insertAdjacentHTML('afterbegin', `
            <li id="list_${likeId}" class="list-group-item">
                <img src="${img}" alt="sumnails" class="sumnails" style="width: 50px;">
                <a href="${location.host + '/post/' + likeId}">
                ${'　' + title}
                </a>
            </li>
            `);
          console.log('2');
        } else if (insertedNum === initialCount & $(`#btn_${likeId}`).html().indexOf(' いいね済み ') !== -1) {
          // 最初からいいね済みの状態を取り消す(unlike)
          insertedNum = initialCount - 1;
          $(`#btn_${likeId}`).html(`
                  <i class="fas fa-heart"></i> いいね <span id="count_${likeId}"
                  data-inserted="${insertedNum}" data-count="${initialCount}">${insertedNum}</span>
              `);
          $(`#list_${likeId}`).remove();
        } else if (insertedNum === initialCount - 1 & $(`#btn_${likeId}`).html().indexOf(' いいね ') !== -1) {
          // いいね済みに戻す（like）
          insertedNum = initialCount;
          $(`#btn_${likeId}`).html(`
                  <i class="fas fa-heart"></i> いいね済み <span id="count_${likeId}"
                  data-inserted="${insertedNum}" data-count="${initialCount}">${insertedNum}</span>
              `);
          document.getElementById('like-list').insertAdjacentHTML('afterbegin', `
            <li id="list_${likeId}" class="list-group-item">
                <img src="${img}" alt="sumnails" class="sumnails" style="width: 50px;">
                <a href="${location.host + likeId}">
                ${'　' + title}
                </a>
            </li>
            `);
          console.log('4');
        } else {
          // 初回いいね
          insertedNum = initialCount + 1;
          $(`#btn_${likeId}`).html(`
                  <i class="fas fa-heart"></i> いいね済み <span id="count_${likeId}"
                  data-inserted="${insertedNum}" data-count="${initialCount}">${insertedNum}</span>
              `);
          document.getElementById('like-list').insertAdjacentHTML('afterbegin', `
            <li id="list_${likeId}" class="list-group-item">
                <img src="${img}" alt="sumnails" class="sumnails" style="width: 50px;">
                <a href="${location.host + likeId}">
                ${'　' + title}
                </a>
            </li>
            `);
          console.log('5');
        }
        $('[data-like]').off();
      }).fail(function(jqXHR, textStatus, errorThrown) {
        alert('ファイルの取得に失敗しました。');
        console.log('ajax通信に失敗しました');
        console.log(jqXHR.status);
        console.log(textStatus);
        console.log(errorThrown.message);
      }).always(function() {
        self.prop('disabled', false);
      });
    });
  }
});
