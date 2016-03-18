/*global $, alert, document, console*/

var serverIpAddress = "10.249.167.230";

//Function to send a request
function sendRequest(u) {
    "use strict";
    var obj, result;
    obj = $.ajax({url: u, async: false});
    result = $.parseJSON(obj.responseText);
    return result;
}//end of sendRequest(u)


//Function to display events
$(document).ready(function () {
    "use strict";
    // url = "http://10.249.167.230/vf_hackathon/utick_VFHACKATHON/controllers/event_transaction_controllers.php?cmd=1",
    var obj, div = "", index,
        url = "https://gh-disaster-relief.appspot.com/_ah/api/ticketApi/v1/ticket";
    obj = sendRequest(url);
    for (index in obj.items) {
        if (obj.items.hasOwnProperty(index)) {
            div += '<div class="col-sm-4">';
            div += '<div class="product-image-wrapper">';
            div += '<div class="single-products">';
            div += '<div class="productinfo text-center">';
            div += '<img src="../../images/mockingjay.png" alt="Image"/>';
            div += '<h2> GHS ' + obj.items[index].price + '</h2>';
            div += '<p>' + obj.items[index].name + '</p>';
            div += '<a href="event_details.php?cmd=21&id=' + obj.items[index].id + '&name=' + obj.items[index].name +
                '&price=' + obj.items[index].price + '&seats=' + obj.items[index].seats + '&desc=' + obj.items[index].description +
                'id="' + obj.items[index].id + '" class="btn btn-default add-to-cart">' +
                '<i class="fa fa-search"></i>View Details</a>';
            div += '</div></div>';
            div += '<div class="choose">';
            div += '<ul class="nav nav-justified">';
            div += '<li><a href="#" id="' + obj.items[index].id + '">' +
                '<i class="fa fa-shopping-cart"></i>Add to cart</a></li>';
            div += '</ul></div></div></div>';
        }
    }
    $(".displayEvents").html(div);
    // }
});