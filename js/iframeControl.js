document.addEventListener("DOMContentLoaded", function(){
    const toggleButtons = document.querySelectorAll('.iframe-toggle');

    toggleButtons.forEach(function(button){
        button.addEventListener('click', function(){
            const container = button.closest('.iframe-container');
            const iframe = container.querySelector('iframe');
            if(!container.classList.contains('fullscreen')){
                // Save current styles so they can be restored later
                container.dataset.originalStyle = container.getAttribute('style') || '';
                iframe.dataset.originalStyle = iframe.getAttribute('style') || '';
                // Set container to full screen
                container.style.position = 'fixed';
                container.style.top = '0';
                container.style.left = '0';
                container.style.width = '100vw';
                container.style.height = '100vh';
                container.style.zIndex = '9999';
                // Adjust iframe to fill the container
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                container.classList.add('fullscreen');
                button.textContent = 'Restore';
            } else {
                // Restore original styles
                container.setAttribute('style', container.dataset.originalStyle);
                iframe.setAttribute('style', iframe.dataset.originalStyle);
                container.classList.remove('fullscreen');
                button.textContent = 'Expand';
            }
        });
    });
});

