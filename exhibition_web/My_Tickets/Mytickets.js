const userId = sessionStorage.getItem("userId");

if (!userId) {
    window.location.href = "../login/login.html";
}

function viewTicketDetail(bookingID) {
    sessionStorage.setItem("selectedBookingID", bookingID);
    window.location.href = "../TicketDetail/TicketDetail.php";
}

fetch('../Controller/get_all_tickets.php?userId=' + userId)
    .then(res => {
        // ตรวจสอบ status code
        if (!res.ok) {
            throw new Error('Error: ' + res.status);
        }
        return res.text(); // อ่านเป็นข้อความธรรมดาก่อน
    })
    .then(data => {
        try {
            // ถ้ามีข้อมูล HTML หรือ error page จะไม่สามารถแปลงเป็น JSON ได้
            const jsonData = JSON.parse(data);

            const container = document.getElementById("all-tickets-container");

            // ถ้าข้อมูลว่าง
            if (jsonData.length === 0) {
                container.innerHTML = "<p>You don't have a ticket yet</p>";
                return;
            }

            // แสดงข้อมูลตั๋วที่ได้รับ
            jsonData.forEach(ticket => {
                const div = document.createElement("div");
                div.className = "ticket-card";

                // ฟังก์ชันแปลงวันที่
                function formatDate(dateStr) {
                    const date = new Date(dateStr);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                }

                // ฟังก์ชันแปลงราคา
                function formatPrice(price) {
                    const parsedPrice = parseFloat(price);
                    if (isNaN(parsedPrice)) {
                        return '0';
                    }
                    return parsedPrice.toFixed(0);
                }

                //แปลงเวลา
                function formatTime(timeStr) {
                    const timeParts = timeStr.split(':');
                    return timeParts[0] + ':' + timeParts[1];
                }

                div.innerHTML = `
                    <div class="ticket-image">
                        <img src ="../Picture/ex6.jpeg">
                    </div>
                    <div class="ticket-info">
                        <div class="ticket-header">
                            <div class="left">
                                <p><strong>Date:</strong> ${formatDate(ticket.Date)}</p>
                                <p><strong>Event:</strong> ${ticket.Title}</p>
                                <p>Bangkok Art Gallery</p>
                            </div>
                            <div class="right">
                                <p>Order No. ${ticket.BookingID}</p>
                            </div>
                        </div>
                        <div class="ticket-table">
                            <div class="table-header">
                                <span><strong>Ticket type</strong></span>
                                <span>Price</span>
                            </div>
                            <div class="table-row">
                                <span>${ticket.Ticket_type}</span>
                                <span>${formatPrice(ticket.Price)} Baht</span>
                            </div>
                            <div class="event-time">
                                <div class="left">
                                    <p><strong>Event time</strong></p>
                                    <p>${formatDate(ticket.Date)} ${formatTime(ticket.Time_Slot)}</p>
                                </div>
                            </div>
                            <button class="view-ticket-btn" id="viewticket"onclick="viewTicketDetail('${ticket.BookingID}')">
                                View Ticket Detail
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
            
        } catch (err) {
            console.error('An error occurred converting JSON data:', err);
            document.getElementById("all-tickets-container").innerHTML = "<p>An error occurred while loading data.</p>";
        }
    })
    .catch(err => {
        console.error('An error occurred while retrieving data:', err);
        document.getElementById("all-tickets-container").innerHTML = "<p>An error occurred while loading data.</p>";
    });
