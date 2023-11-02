const prevNextIcon = document.querySelectorAll(".icons span");
var selectedDate = '';
var selectedMonth = '';
var selectedYear = "";

// getting new date, current year and month
let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"
];

const renderCalendar = () => {

    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        const mock_cur_date = new Date(currYear, currMonth, i);

        var isToday = '';
        if (selectedMonth != ''){
            isToday = i === selectedDate && selectedMonth === currMonth &&
            currYear === new Date().getFullYear() ? "active" : "";
            if (i === selectedDate && currMonth === selectedMonth && currYear === new Date().getFullYear() && mock_cur_date.getDay() != 0) {
                const displayDate = new Date(currYear, currMonth, selectedDate).toDateString();
                document.getElementById("dateDisplay").value = displayDate;
                document.getElementById("dateDisplay").innerText = displayDate;
                let currentDate = `${selectedDate}-${currMonth+1}-${currYear}`;
                document.getElementById("selectedDate").value = currentDate;
            }
        } else{
            isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
            currYear === new Date().getFullYear() ? "active" : "";

            if (i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() && mock_cur_date.getDay() != 0) {
                selectedDate = i;
                const displayDate = new Date(currYear, currMonth, selectedDate).toDateString();
                document.getElementById("dateDisplay").value = displayDate;
                document.getElementById("dateDisplay").innerText = displayDate;
                let currentDate = `${selectedDate}-${currMonth+1}-${currYear}`;
                
                document.getElementById("selectedDate").value = currentDate;
                window.Livewire.dispatch('setInitialSelectedDate', {message: currentDate});
            }
        }

        if (mock_cur_date.getDay() == 0 ) {
            liTag += `<li class="inactive">${i}</li>`;
        } else {
            let currentDate = `${i}-${currMonth+1}-${currYear}`;
            liTag += `<li class="date-select ${isToday}" wire:click="setSelectedDate('${currentDate}')">${i}</li>`;
        }
    }

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    const daysTag = document.getElementById("calendarDays"),
        currentDate = document.querySelector(".current-date");

    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
    const dateSelector = document.querySelectorAll(".date-select");
    dateSelector.forEach(icon => {
        icon.addEventListener("click", () => {
            const selectedDay = parseInt(icon.innerText);
            onClickCalendar(selectedDay);
        });
    });

}

const onClickCalendar = (selectedDay) => {
    const dateSelector = document.querySelectorAll(".date-select");
    dateSelector.forEach(icon => {
        const dayOfMonth = parseInt(icon.innerText);
        if (dayOfMonth == selectedDay) {
            icon.classList.add('active');
            selectedDate = dayOfMonth;
            const displayDate = new Date(currYear, currMonth, selectedDay).toDateString();
            document.getElementById("dateDisplay").value = displayDate;
            let currentDate = `${selectedDay}-${currMonth+1}-${currYear}`;
            document.getElementById("selectedDate").innerText = currentDate;
            document.getElementById("selectedDate").value = currentDate;
            selectedMonth = currMonth;
            selectedYear = selectedYear;
        } else {
            icon.classList.remove('active');
        }
    });
}


prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        
        if (icon.id === "prev" && new Date(currYear, currMonth , 0) < new Date()){
            alert("We do not allow reserve backward in the last month");
            end;
        }
        //if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
        if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});

document.addEventListener('livewire:initialized', () => {
    renderCalendar();
    Livewire.on('searchTermUpdated', (event) => {
        console.log(event);
        // setTimeout(function() {  
        //     console.log(selectedDate);
        //     //renderCalendar();
        // }, 3);
    });
});

const showSmartMenu = () => {
    const menuPanel = document.getElementById("menuPanel")
    // current scroll position 
    var st = document.documentElement.scrollTop;
    
    console.log(st);
    if (st>=525){
        menuPanel.className = "menuPanel show-menu";
    }else{
        menuPanel.className = "menuPanel hide-menu";
    }
}

window.addEventListener("scroll", showSmartMenu);