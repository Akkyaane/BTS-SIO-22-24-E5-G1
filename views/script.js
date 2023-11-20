function showDiv(select) {
    const selectedValue = parseInt(select.value);

    const kilometersExpense = document.getElementById('kilometers_expense');
    const transportExpense = document.getElementById('transport_expense');
    const transportExpenseFile = document.getElementById('transport_expense_file');

    if (selectedValue != 4) {
        kilometersExpense.style.display = "none";
        transportExpense.style.display = "block";
        transportExpenseFile.style.display = "block";
    } else {
        kilometersExpense.style.display = "block";
        transportExpense.style.display = "none";
        transportExpenseFile.style.display = "none";
    }
}

function charCount() {
    const textarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
    const remainingChars = textarea.value.length;
    charCount.textContent = `${remainingChars}/500`;
    });
};