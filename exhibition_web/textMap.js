const textMap = {
    en: {
      helpHeader: "Need help?",
      orgnHeader: "Event Organizer",
      myTicketsHeader: "My Tickets",
      logoutHeader: "Log out",
      registerHeader: "Register |",
      signInHeader: "Sign in",
      dateTime: "Date & Time",
      ticketDetail: "Ticket details",
      ticketType: "Ticket type",
      ticketPrice: "Price",
      ticketQnty: "Quantity",
      closeMsg: "Ticket booking is currently closed. Please check back later.",
      buyButton: "Buy Tickets",
      ticketTypeLabel: "Ticket type",
      ticketQuantityLabel: "Quantity",
      ticketPriceLabel: "Price",
      ticketSubtotalLabel: "Subtotal",
      ticketFeeLabel: "Fee",
      ticketTotalLabel: "Total",
      paymentSuccess: "Payment Successful!",
      viewticket: "View Ticket detail",
      homeBtn: "Back to Homepage",
      ticketDetailText: "Ticket Details",
      eventTime: "Event time",
      helpFooter: "Need help?",
      customerFooter: "Customer support",
      forOrgn: "For Event Organizers",
      legalFooter: "Legal",
      faqBuy: "How to buy tickets?",
      faqWhere: "Where are my tickets?",
      faqUse: "How to use e-ticket?",
      helpCenter: "Help Center",
      ourSolutions: "Our Solutions",
      pricing: "Pricing",
      contactUs: "Contact Us",
      terms: "Terms",
      policy: "Policy",
      security: "Security",
      emailText: "Email",
      signInTitle: "Sign In",
      passwordText: "Password",
      signInBtn: "Sign in",
      newUser: "New user?",
      registerlink: "Register",
      registerTitle: "Register",
      registerBtn: "Register",
      backBtn: "Back to Homepage",
      myTickets: "My tickets",
      exhibition_intro_p1: "Embark on a journey into 'World of Art', an exhibition showcasing a diverse range of artworks from both local and international artists. This exhibition will take you through the various facets of the art world, from paintings and sculptures to photography, mixed media, and installations, offering a fresh perspective on art appreciation.",
      exhibition_intro_p2: "'World of Art' is more than just an art exhibition; it's a space for creative exchange and inspiration. This exhibition will provide opportunities to get to know the artists and their works intimately through talks, demonstrations, and other activities that will deepen your understanding of the creative process and the artists' concepts.",
      exhibition_intro_p3: "Whether you're an art collector, an artist, or simply an art enthusiast, 'World of Art' promises an unforgettable experience that will enrich your appreciation for art.",
      ticket_description_1: `Student Ticket & Senior Ticket & Kid Ticket<br>- Apply for height not over 120 cm.<br>- Under 120 cm must be accompanied by an adult.<br>- Students<br>- Senior over 60 years age`,
      ticket_description_2: `Adult ticket`,
      ticket_description_3: `Couple ticket<br>- 2 Adults`,
      sold_ut: "Sold out"
    },
    th: {
      helpHeader: "ช่วยเหลือ",
      orgnHeader: "ผู้จัดงาน",
      myTicketsHeader: "บัตรของฉัน",
      logoutHeader: "ลงชื่อออก",
      registerHeader: "ลงทะเบียน |",
      signInHeader: "เข้าสู่ระบบ",
      dateTime: "วัน & เวลา",
      ticketDetail: "รายละเอียดบัตร",
      ticketType: "ประเภทบัตร",
      ticketPrice: "ราคา",
      ticketQnty: "จำนวน",
      closeMsg: "ขณะนี้ปิดการจองตั๋วแล้ว กรุณาตรวจสอบอีกครั้งในภายหลัง",
      buyButton: "ซื้อบัตร",
      ticketTypeLabel: "ประเภทบัตร",
      ticketQuantityLabel: "จำนวน",
      ticketPriceLabel: "ราคา",
      ticketSubtotalLabel: "ราคา",
      ticketFeeLabel: "ค่าธรรมเนียม",
      ticketTotalLabel: "ราคาสุทธิ",
      paymentSuccess: "ชำระเงินสำเร็จ!",
      viewticket: "ดูรายละเอียดบัตร",
      homeBtn: "กลับสู่หน้าหลัก",
      ticketDetailText: "รายละเอียดบัตร",
      eventTime: "วันและเวลา",
      helpFooter: "ต้องการความช่วยเหลือ?",
      customerFooter: "ฝ่ายสนับสนุนลูกค้า",
      forOrgn: "สำหรับผู้จัดงาน",
      legalFooter: "ข้อกำหนดทางกฎหมาย",
      faqBuy: "วิธีซื้อบัตร?",
      faqWhere: "ฉันจะหาบัตรของฉันได้ที่ไหน?",
      faqUse: "วิธีใช้ e-ticket?",
      helpCenter: "ศูนย์ช่วยเหลือ",
      ourSolutions: "โซลูชันของเรา",
      pricing: "อัตราค่าบริการ",
      contactUs: "ติดต่อเรา",
      terms: "ข้อกำหนดและเงื่อนไข",
      policy: "นโยบายและแนวปฏิบัติ",
      security: "มาตรการรักษาความปลอดภัย",
      emailText: "อีเมลล์",
      signInTitle: "ลงชื่อเข้าใช้",
      passwordText: "รหัสผ่าน",
      signInBtn: "เข้าสู่ระบบ",
      newUser: "ผู้ใช้ใหม่?",
      registerlink: "ลงทะเบียน",
      registerTitle: "ลงทะเบียน",
      registerBtn: "ลงทะเบียน",
      backBtn: "กลับสู่หน้าหลัก",
      myTickets: "บัตรของฉัน",
      exhibition_intro_p1: "ร่วมออกเดินทางสู่ 'โลกแห่งศิลปะ' นิทรรศการที่รวบรวมผลงานศิลปะหลากหลายรูปแบบจากทั้งศิลปินไทยและต่างประเทศ ซึ่งจะพาคุณสัมผัสแง่มุมต่าง ๆ ของโลกศิลปะ ตั้งแต่จิตรกรรม ประติมากรรม ภาพถ่าย สื่อผสม ไปจนถึงงานติดตั้งศิลป์ พร้อมเปิดมุมมองใหม่ในการชมงานศิลป์",
      exhibition_intro_p2: "'โลกแห่งศิลปะ'ไม่ใช่แค่นิทรรศการศิลปะธรรมดา แต่เป็นพื้นที่แห่งการแลกเปลี่ยนและสร้างแรงบันดาลใจ คุณจะได้รู้จักศิลปินและผลงานของพวกเขาอย่างใกล้ชิด ผ่านกิจกรรมพูดคุย สาธิต และเวิร์กชอปต่าง ๆ ที่จะช่วยให้เข้าใจแนวคิดและกระบวนการสร้างสรรค์ได้ลึกซึ้งยิ่งขึ้น",
      exhibition_intro_p3: "ไม่ว่าคุณจะเป็นนักสะสมศิลปะ ศิลปิน หรือคนที่รักในงานศิลป์ 'โลกแห่งศิลปะ' จะมอบประสบการณ์อันน่าจดจำที่จะเติมเต็มความหลงใหลในงานศิลป์ของคุณ",
      ticket_description_1: `ตั๋วสำหรับนักเรียน, ผู้สูงอายุ, และเด็ก<br>- ใช้ได้สำหรับผู้ที่มีความสูงไม่เกิน 120 ซม.<br>- ผู้ที่มีความสูงต่ำกว่า 120 ซม. ต้องมากับผู้ใหญ่<br>- นักเรียน/นักศึกษา<br>- ผู้สูงอายุ อายุมากกว่า 60 ปี`,
      ticket_description_2: `ตั๋วผู้ใหญ่`,
      ticket_description_3: `ตั๋วคู่<br>- ผู้ใหญ่ 2 คน`,
      sold_out: "หมด",
    }
  };
  
  function updateText(id, text, isHTML = false) {
    const el = document.getElementById(id);
    if (el) {
        if (isHTML) {
            el.innerHTML = text;
        } else {
            el.textContent = text;
        }
    }
}

  
  function setLanguage(lang) {
    localStorage.setItem("lang", lang);
    const mapping = textMap[lang];

    if (typeof lang === 'string') {
      const languageToggle = document.getElementById('language-toggle');
      if (languageToggle) {
        languageToggle.textContent = lang.toUpperCase();
      }
    }
  
    updateText('helpHeader', mapping.helpHeader);
    updateText('orgnHeader', mapping.orgnHeader);
    updateText('myTicketsHeader', mapping.myTicketsHeader);
    updateText('logoutHeader', mapping.logoutHeader);
    updateText('registerHeader', mapping.registerHeader);
    updateText('signInHeader', mapping.signInHeader);
    updateText('dateTime', mapping.dateTime);
    updateText('ticketTypeHeader', mapping.ticketType);
    updateText('ticketPriceHeader', mapping.ticketPrice);
    updateText('ticketQntyHeader', mapping.ticketQnty);
    updateText('ticketDetailTitle', mapping.ticketDetail);
    updateText('closeMsg', mapping.closeMsg);
    updateText('buyButton', mapping.buyButton);
    
    updateText('ticketTypeLabel', mapping.ticketTypeLabel);
    updateText('ticketQuantityLabel', mapping.ticketQuantityLabel);
    updateText('ticketPriceLabel', mapping.ticketPriceLabel);
    updateText('ticketSubtotalLabel', mapping.ticketSubtotalLabel);
    updateText('ticketFeeLabel', mapping.ticketFeeLabel);
    updateText('ticketTotalLabel', mapping.ticketTotalLabel);
    updateText('paymentSuccess', mapping.paymentSuccess);
    updateText('viewticket', mapping.viewticket);
    updateText('homeBtn', mapping.homeBtn);
    updateText('ticketDetailText', mapping.ticketDetailText);
    updateText('eventTime', mapping.eventTime);
  
    updateText('helpFooter', mapping.helpFooter);
    updateText('customerFooter', mapping.customerFooter);
    updateText('forOrgn', mapping.forOrgn);
    updateText('legalFooter', mapping.legalFooter);
    updateText('faqBuy', mapping.faqBuy);
    updateText('faqWhere', mapping.faqWhere);
    updateText('faqUse', mapping.faqUse);
    updateText('helpCenter', mapping.helpCenter);
    updateText('ourSolutions', mapping.ourSolutions);
    updateText('pricing', mapping.pricing);
    updateText('contactUs', mapping.contactUs);
    updateText('terms', mapping.terms);
    updateText('policy', mapping.policy);
    updateText('security', mapping.security);

    updateText('signInTitle', mapping.signInTitle);
    updateText('signInBtn', mapping.signInBtn);
    updateText('registerlink', mapping.registerlink);
    updateText('newUser', mapping.newUser);
    updateText('registerTitle', mapping.registerTitle);
    updateText('registerBtn', mapping.registerBtn);
    updateText('backBtn', mapping.backBtn);
    updateText('myTickets', mapping.myTickets);
    updateText('exhibition_intro_p1', mapping.exhibition_intro_p1);
    updateText('exhibition_intro_p2', mapping.exhibition_intro_p2);
    updateText('exhibition_intro_p3', mapping.exhibition_intro_p3);
    updateText('sold_out', mapping.sold_out);

    updateText('ticket_description_1', mapping.ticket_description_1, true);
    updateText('ticket_description_2', mapping.ticket_description_2, true);
    updateText('ticket_description_3', mapping.ticket_description_3, true);

    updateTicketAvailability();
  }
  
  document.addEventListener("DOMContentLoaded", () => {
    const lang = localStorage.getItem("lang") || "en";
    setLanguage(lang);
    const t = textMap[lang];
  
    document.getElementById("ticket_description_1").innerHTML = t.ticket_description_1;
    document.getElementById("ticket_description_2").innerHTML = t.ticket_description_2;
    document.getElementById("ticket_description_3").innerHTML = t.ticket_description_3;
  
    document.querySelectorAll(".language-dropdown a").forEach(link => {
      link.addEventListener("click", function(e) {
        e.preventDefault();
        const selectedLang = this.dataset.lang;
        setLanguage(selectedLang);
      });
    });
  });
  
  