// function showDiv(select) {
//     const selectedValue = parseInt(select.value);

//     const kilometersNumber = document.getElementById('kilometers_number');
//     const transportExpense = document.getElementById('transport_expense');
//     const transportExpenseFile = document.getElementById('transport_expense_file');

//     if (selectedValue != 4) {
//         kilometersNumber.style.display = "none";
//         transportExpense.style.display = "block";
//         transportExpenseFile.style.display = "block";
//     } else {
//         kilometersNumber.style.display = "block";
//         transportExpense.style.display = "none";
//         transportExpenseFile.style.display = "none";
//     };
// };

function charCount() {
    const textarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
    const remainingChars = textarea.value.length;
    charCount.textContent = `${remainingChars}/500`;
    });
};