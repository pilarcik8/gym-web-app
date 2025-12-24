(function () {
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modal-add-credit');
        if (!modal) return;

        const modalId = document.getElementById('modal-account-id');
        const modalMessage = document.getElementById('modal-message');
        const amountInput = document.getElementById('modal-amount');
        const cancelBtn = document.getElementById('modal-button-cancel');

        function openModal(id, name) {
            if (modalId) modalId.value = id || '';
            if (modalMessage) modalMessage.textContent = 'zákazníkovy ' + (name || '');
            if (amountInput) amountInput.value = '';
            modal.classList.add('active');
            if (amountInput) amountInput.focus();
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        document.querySelectorAll('.open-add-credit').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name') || '';
                openModal(id, name);
            });
        });

        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

        // close when clicking outside modal card
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });

        // close on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
        });
    });
})();
