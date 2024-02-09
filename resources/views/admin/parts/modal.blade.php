<div class="xm-modal">
    <div class="modal-overlay"></div>
    <div class="modal-item" id="confirm-modal">
        <div class="modal-title">
            Подтвердите действие
        </div>
        <div class="modal-message">
            Вы действительно хотите удалить?
        </div>
        <div class="modal-footer">
            <form action="" method="post">
                {!! method_field('delete') !!}
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
            <button type="button" class="btn btn-secondary">Отмена</button>
        </div>
    </div>

    <div class="modal-item min-height-100" id="update-user">

    </div>
</div>

<script>
    function callModal(modal_id) {
        let container = $('.xm-modal');
        let item = container.find('#'+modal_id);

        container.fadeIn(200, function () {
            item.addClass('show');
        })
    }

    function closeModal() {
        let container = $('.xm-modal'),
            items = container.find('.modal-item');

        container.find('form').attr('action', '');
        items.each(function () {
            $(this).removeClass('show')
        });

        setTimeout(function () {
            container.fadeOut(200);
        }, 300)
    }

    $('body').on('click', '.modal-overlay,.modal-item button[type="button"]', function () {
        closeModal();
    });

    function confirmDelete(event,url) {
        event.preventDefault();
        $('#confirm-modal form').attr('action', url);
        callModal('confirm-modal');
    }
</script>
