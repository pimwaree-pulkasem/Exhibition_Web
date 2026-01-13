const slider = document.querySelector('.slider');
const images = document.querySelectorAll('.slider img');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
const currentLang = localStorage.getItem("lang") || "en";

let currentIndex = 0;

function updateSlider() {
    const slideWidth = images[0].clientWidth;
    slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % images.length;
    updateSlider();
});

prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateSlider();
});

window.addEventListener('resize', updateSlider);

document.addEventListener("DOMContentLoaded", function () {
    const isLoggedIn = document.body.getAttribute("data-logged-in") === "true";
    const userId = document.body.getAttribute("data-user-id");

    if (userId !== 'null') {
        sessionStorage.setItem("userId", userId);
    }

    const form = document.querySelector("#booking-form");

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const adult = parseInt(document.getElementById("adult_quantity").value);
        const couple = parseInt(document.getElementById("couple_quantity").value);
        const student = parseInt(document.getElementById("student_quantity").value);
        const total = adult + couple + student;
        const totalQnty = adult + (couple*2) + student;

        const date = document.getElementById("date").value;
        const time = document.getElementById("time").value;

        if (!isLoggedIn) {
            alert("Please log in before booking tickets.");
            return;
        }

        if (total === 0) {
            alert("Please select at least one ticket from any category.");
            return;
        }

        if (adult > 4 || couple > 4 || student > 4) {
            alert("You can select up to 4 tickets per category.");
            return;
        }

        const formData = new URLSearchParams();
        formData.append("date", date);
        formData.append("time", time);
        formData.append("total", totalQnty);

        try {
            const response = await fetch("../Controller/check_capacity.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: formData.toString()
            });

            const data = await response.json();

            if (data.available) {
                const studentPrice = 250;
                const adultPrice = 400;
                const couplePrice = 720;

                const totalPrice = student * studentPrice + adult * adultPrice + couple * couplePrice;

                sessionStorage.setItem("ticketType", "Student, Adult, Couple");
                sessionStorage.setItem("quantity", student + ", " + adult + ", " + couple);
                sessionStorage.setItem("price", totalPrice);
                sessionStorage.setItem("exhibitionId", "1");
                sessionStorage.setItem("selectedDate", date);
                sessionStorage.setItem("selectedTime", time);
                sessionStorage.setItem("justBought", "false");

                sessionStorage.setItem("student_quantity", student);
                sessionStorage.setItem("adult_quantity", adult);
                sessionStorage.setItem("couple_quantity", couple);
                sessionStorage.setItem("total_quantity", totalQnty);


                e.target.submit(); // ส่งฟอร์มหลังเช็คทุกอย่างผ่าน
            } else {
                alert(`The number of selected tickets exceeds capacity. Only ${data.remaining} tickets left.`);
            }
        } catch (error) {
            console.error("Error checking capacity:", error);
            // alert("Something went wrong while checking availability. Please try again.");
        }
    });
});

async function updateTicketAvailability() {
    const currentLang = localStorage.getItem("lang") || "en";
    const soldOutText = textMap[currentLang]?.sold_out || "Sold out";
    const date = document.getElementById("date").value;
    const time = document.getElementById("time").value;

    const formData = new URLSearchParams();
    formData.append("date", date);
    formData.append("time", time);
    formData.append("total", 1);

    try {
        const response = await fetch("../Controller/check_capacity.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: formData.toString()
        });

        const data = await response.json();

        const allRows = document.querySelectorAll(".ticket-table tbody tr");

        if (!data.available || data.remaining <= 0) {
            const soldOutText = textMap[currentLang]?.sold_out || 'Sold out';
            allRows.forEach(row => {
                const td = row.children[2];
                td.innerHTML = `<span class="sold-out">${soldOutText}</span>`;
            });

            // ซ่อนปุ่ม "Buy Tickets"
            document.getElementById("buyButton")?.classList.add("hidden");
        } else {
            allRows.forEach((row, index) => {
                const td = row.children[2];
                let max = index === 2 ? 2 : 4; // couple มีแค่ 2
                let options = '';
                for (let i = 0; i <= max; i++) {
                    options += `<option value="${i}">${i}</option>`;
                }

                const name = row.querySelector("select")?.name || ['student_quantity', 'adult_quantity', 'couple_quantity'][index];
                const id = row.querySelector("select")?.id || ['student_quantity', 'adult_quantity', 'couple_quantity'][index];

                td.innerHTML = `<select id="${id}" name="${name}">${options}</select>`;
            });
            
            document.getElementById("buyButton")?.classList.remove("hidden");
        }
    } catch (error) {
        console.error("Error checking capacity:", error);
    }
}

// ติด event listener
document.getElementById("date").addEventListener("change", updateTicketAvailability);
document.getElementById("time").addEventListener("change", updateTicketAvailability);

updateTicketAvailability();

