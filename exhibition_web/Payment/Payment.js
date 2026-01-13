document.addEventListener("DOMContentLoaded", () => {
    // Function to handle payment method selection
    function selectPaymentMethod(method) {
        // Remove selected class from all icons
        document.querySelectorAll('.icon').forEach(icon => {
            icon.classList.remove('selected-payment');
        });
        
        // Add selected class to clicked icon
        document.getElementById(method).classList.add('selected-payment');
        
        // Enable the buy button
        const buyButton = document.getElementById('buyBtn');
        if (buyButton) {
            buyButton.disabled = false;
        }
    }

    window.selectPaymentMethod = selectPaymentMethod;

    const ticketTypes = ["Student Ticket & Senior Ticket & Kid Ticket", "Adult ticket", "Couple ticket"];
    const quantitiesString = sessionStorage.getItem("quantity");

    if (!quantitiesString) {
        console.warn("No ticket quantity data found in sessionStorage.");
        return;
    }

    const quantities = quantitiesString.split(",").map(q => parseInt(q.trim()));
    const prices = {
        "Student Ticket & Senior Ticket & Kid Ticket": 250,
        "Adult ticket": 400,
        "Couple ticket": 720
    };

    const ticketTable = document.querySelector(".ticket-table");
    const footerRows = ticketTable.querySelectorAll(".row.footer, .row.total");

    let subtotal = 0;

    // Remove existing rows if any
    const existingRows = ticketTable.querySelectorAll(".row:not(.header):not(.summary):not(.total)");
    existingRows.forEach(row => row.remove());

    const summaryRows = ticketTable.querySelectorAll(".row.summary");
    ticketTypes.forEach((type, index) => {
        const qty = quantities[index];
        if (qty > 0) {
            const price = prices[type];
            const total = qty * price;
            subtotal += total;

            const row = document.createElement("div");
            row.classList.add("row");
            row.innerHTML = `
                <div class="cell">${type}</div>
                <div class="cell">${qty}</div>
                <div class="cell">${total} ฿</div>
            `;
            ticketTable.insertBefore(row, summaryRows[0]);
        }
    });

    const fee = 20;
    const total = subtotal + fee;

    // Update totals display
    const subtotalCell = document.getElementById("subtotal");
    const feeCell = document.getElementById("fee");
    const totalCell = document.getElementById("total");

    if (subtotalCell) subtotalCell.textContent = `${subtotal} ฿`;
    if (feeCell) feeCell.textContent = `${fee} ฿`;
    if (totalCell) totalCell.textContent = `${total} ฿`;

    // Handle buy button click
    document.getElementById("buyBtn").addEventListener("click", () => {
        // Prepare tickets array
        const ticketTypes = [
            { type: "Student Ticket & Senior Ticket & Kid Ticket", key: "student_quantity", price: 250 },
            { type: "Adult ticket", key: "adult_quantity", price: 400 },
            { type: "Couple ticket", key: "couple_quantity", price: 720 }
        ];

        const tickets = [];

        ticketTypes.forEach(ticket => {
            const qty = parseInt(sessionStorage.getItem(ticket.key) || "0");
            if (qty > 0) {
                tickets.push({
                    type: ticket.type,
                    price: ticket.price,
                    quantity: qty
                });
            }
        });

        const data = {
            userId: sessionStorage.getItem("userId"),
            exhibitionId: sessionStorage.getItem("exhibitionId"),
            date: sessionStorage.getItem("selectedDate"),
            time: sessionStorage.getItem("selectedTime"),
            tickets: tickets
        };

        // Send to insert_booking.php
        fetch("../Controller/insert_booking.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        }).then(res => {
            if (res.ok) {
                sessionStorage.setItem("justBought", "true");
                window.location.href = "../Payment Success/PaymentSuccess.php";
            } else {
                alert("Something went wrong during booking.");
            }
        });
    });
});
