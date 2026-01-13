const userId = sessionStorage.getItem("userId");
const selectedBookingID = sessionStorage.getItem("selectedBookingID");
const totalQnty = sessionStorage.getItem("total_quantity");
const container = document.getElementById("ticket-container");

// if (sessionStorage.getItem("justBought") !== "true") {
//     window.location.href = "../My tickets/Mytickets.php";
// }

function formatDate(dateStr) {
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

function formatPrice(price) {
    const parsedPrice = parseFloat(price);
    if (isNaN(parsedPrice)) {
        return '0';
    }
    return parsedPrice.toFixed(0);
}

function formatTime(timeStr) {
    const timeParts = timeStr.split(':');
    return timeParts[0] + ':' + timeParts[1];
}

function renderTicket(ticket) {
    const div = document.createElement("div");
    div.className = "ticket-box";
    div.innerHTML = `
        <div class="ticket-image">
            <img src="../Picture/ex6.jpeg" alt="Ticket Image" style="width:100%; height:100%; object-fit:cover;">
        </div>
        <div class="ticket-info">
            <div class="ticket-header">
                <div class="left">
                    <p><strong>${formatDate(ticket.Date)}</strong></p>
                    <p>${ticket.Title}</p>
                    <p>Bangkok Art Gallery</p>
                </div>
                <div class="right">
                    <p id="orderText">Order No.${ticket.BookingID}</p>
                </div>
            </div>
            <div class="ticket-table">
                <div class="table-header">
                    <span id="ticketType"><strong>Ticket type</strong></span>
                    <span id="ticketPrice"><strong>Price</strong></span>
                </div>
                <div class="table-row">
                    <span>${ticket.Ticket_type}</span>
                    <span>${formatPrice(ticket.Price)} Baht</span>
                </div>
                <div class="event-time">
                    <div class="left">
                        <p id="eventTime"><strong>Event time</strong></p>
                        <p>${formatDate(ticket.Date)} ${formatTime(ticket.Time_Slot)}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
    container.appendChild(div);
}

if (selectedBookingID) {
    // จากหน้า MyTickets
    fetch(`../Controller/get_ticket_by_booking_id.php?bookingId=${selectedBookingID}`)
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) {
                container.innerHTML = "<p>Ticket not found.</p>";
                return;
            }
            renderTicket(data[0]);
            sessionStorage.removeItem("selectedBookingID");
        })
        .catch(err => {
            console.error('Error:', err);
            container.innerHTML = "<p>An error occurred while loading data.</p>";
        });

} else {
    // จาก Payment Success
    fetch(`../Controller/get_latest_tickets.php?userId=${userId}&total_quantity=${totalQnty}`)
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                container.innerHTML = "<p>Latest ticket not found</p>";
                return;
            }
            data.forEach(ticket => renderTicket(ticket));
            sessionStorage.removeItem("justBought");
        })
        .catch(err => {
            console.error('Error:', err);
            container.innerHTML = "<p>An error occurred while loading data.</p>";
        });
}