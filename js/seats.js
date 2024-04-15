var totalBookedSeats = 0;
var maximumSeats=1;
var mostAmtOfSeats=10;

let minus_button = document.getElementById('minus-seats');
let add_button = document.getElementById('add-seats');
let bookedSeatsSpan = document.getElementById('booked-seats');
let bookedSeatsInput = document.getElementById('booking_seats');

let bookingDetails = {
    id: document.getElementById('booking_id'),
    name: document.getElementById('booking_name'),
    departure: document.getElementById('booking_departure'),
    arrival: document.getElementById('booking_arrival'),
    departure_date: document.getElementById('booking_departure_date'),
    departure_time: document.getElementById('booking_departure_time')
};

let openBookDialog= (id)=>{
    document.getElementById('book-dialog').show();
    fetch('utils/flightdetails.php?id='+id).then((result)=>{
        result.json().then((json)=>{
            bookingDetails.id.value = json["id"];
            bookingDetails.name.innerHTML=json["name"];
            bookingDetails.departure.innerHTML=json["departure"];
            bookingDetails.arrival.innerHTML=json["arrival"];
            bookingDetails.departure_date.innerHTML=json["departure_date"];
            bookingDetails.departure_time.innerHTML=json["departure_time"];
            maximumSeats = json['seats']-json["seats_booked"];
            maximumSeats = maximumSeats<mostAmtOfSeats? maximumSeats:mostAmtOfSeats;
            if(json['user_seats_booked']>0)
                setTotalBookedSeats(json['user_seats_booked']);
                
            else
                setTotalBookedSeats(1);

            });
    });
};

minus_button.onclick = () => {
    setTotalBookedSeats(totalBookedSeats - 1);
}

add_button.onclick = () => {
    setTotalBookedSeats(totalBookedSeats + 1);
}

let setTotalBookedSeats = (totalBookedSeatsNo) => {
    if (totalBookedSeatsNo < 1) totalBookedSeatsNo = 1;
    if (totalBookedSeatsNo>maximumSeats) return;
    totalBookedSeats = totalBookedSeatsNo;
    bookedSeatsSpan.innerHTML = totalBookedSeats;
    bookedSeatsInput.value = totalBookedSeats;
}