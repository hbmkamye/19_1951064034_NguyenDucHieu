
    var curDate = new Date();
    const weekday = ["Chủ nhật","Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"];
    const d = new Date()
    let day = weekday[d.getDay()];
    // Ngày hiện tại
    var curDay = curDate.getDate();
                 
    // Tháng hiện tại
    var curMonth = curDate.getMonth()+1 ;
                      
    // Năm hiện tại
    var curYear = curDate.getFullYear();
                   
    // Gán vào thẻ HTML
    document.getElementById('current-time').innerHTML =day + ", " + curDay + "/" + curMonth + "/" + curYear;
