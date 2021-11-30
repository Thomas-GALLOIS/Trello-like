function toggleInput(tableId) {
    const nomeTableEl = document.getElementById(`name-${tableId}`);
    const inputTableEl = document.getElementById(`input-${tableId}`);
    if (nomeTableEl.hasAttribute("hidden")) {
        nomeTableEl.removeAttribute("hidden");
        inputTableEl.hidden = true;
    } else {
        inputTableEl.removeAttribute("hidden");
        nomeTableEl.hidden = true;
    }
    //

    //
}
