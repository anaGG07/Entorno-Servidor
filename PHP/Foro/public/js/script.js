const showInput = (id) => {
    const form = document.getElementById(`formResponse${id}`);
    const btn = document.getElementById(`btn-${id}`);

    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden'); 
        btn.classList.add('hidden');
    }
}