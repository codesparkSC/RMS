
var base_url='http://127.0.0.1:8000/api/'

var file_url='http://127.0.0.1:8000'


function alert_success(msg)
{
    Swal.fire({
        title: 'Success',
        text: msg,
        icon: 'success',
        confirmButtonClass: 'btn btn-primary w-xs mt-2',
        buttonsStyling: false,
        showCloseButton: true
       })
}


function alert_error(msg)
{
    Swal.fire({
        title: 'Error',
        text: msg,
        icon: 'Error',
        confirmButtonClass: 'btn btn-primary w-xs mt-2',
        buttonsStyling: false,
        showCloseButton: true
    })
}


function toast_success(msg)
{
  Toastify({
    newWindow: true,
    text: msg,
    gravity:'top',
    position: 'right',
    className: "bg-success",
    stopOnFocus: true,
    offset: {
      x:  50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
      y: 10, // vertical axis - can be a number or a string indicating unity. eg: '2em'
    },
    duration: 3000,
    close:  true,
    
  }).showToast();
}

function toast_error(msg)
{
  Toastify({
    newWindow: true,
    text: msg,
    gravity:'top',
    position: 'right',
    className: "bg-danger",
    stopOnFocus: true,
    offset: {
      x:  50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
      y: 10, // vertical axis - can be a number or a string indicating unity. eg: '2em'
    },
    duration: 3000,
    close:  true,
    
  }).showToast();
}

function seller_list()
{
  $.ajax({
  url: base_url+"seller_list",
  type: "POST",
  success: function(result){
      console.log(result);
      var list = $(".seller_list");
      list.append(new Option('All',''))
      $.each(result.data, function(index, item) {
      list.append(new Option(item.company_name, item.id));
      });
  }
});
}


function country_list()
{
    console.log('country')
  $.ajax({
  url: base_url+"country_list",
  type: "POST",
  success: function(result){
      console.log(result);
      var list = $(".country");
      list.empty().append(new Option('Select Country',''))
      $.each(result.data, function(index, item) {
      list.append(new Option(item.country_name, item.id));
      });
  }
});
}

$('.country').change(function () {
    console.log($('[name=country]').val())
    state_list($('[name=country]').val())
  })

  $('.state').change(function () {
    console.log($('[name=state]').val())
    city_list($('[name=state]').val())
  })

function state_list(id)
{
  $.ajax({
  url: base_url+"state_list",
  type: "POST",
  data:{country_id:id},
  success: function(result){
      console.log(result);
      var list = $(".state");
      list.empty().append(new Option('Select State',''))
      $.each(result.data, function(index, item) {
      list.append(new Option(item.state_name, item.id));
      });
      if(seller_details.address.state!=undefined ||seller_details.address.state!='')
      {
        $('#state').val(seller_details.address.state).trigger('change'); 
      }
  }
});
}

function city_list(id)
{
  $.ajax({
  url: base_url+"city_list",
  type: "POST",
  data:{state_id:id},
  success: function(result){
      console.log(result);
      var list = $(".city");
      list.empty().append(new Option('Select City',''))
      $.each(result.data, function(index, item) {
      list.append(new Option(item.city_name, item.id));
      });
      if(seller_details.address.city!=undefined ||seller_details.address.city!='')
      {
        $('#city').val(seller_details.address.city).trigger('change'); 
      }
  }
});
}


function currency_list()
{
  $.ajax({
  url: base_url+"currency_list",
  type: "POST",
  data:{},
  success: function(result){
      console.log(result);
      var list = $(".currency");
      list.empty().append(new Option('Select Currency',''))
      $.each(result.data, function(index, item) {
      list.append(new Option(item.currency_code +' - '+item.currency_name, item.id));
      });
      // if(seller_details.company.currency_id!=undefined ||seller_details.company.currency_id!='')
      // { 
      //   console.log("currency :"+seller_details.company.currency_id)
      //   $('#currency').val(seller_details.company.currency_id).trigger('change'); 
      // }
  }
});
}


function orderStatus_list()
{
  $.ajax({
  url: base_url+"get_orderstatus",
  type: "POST",
  success: function(result){
      console.log(result);
      var list = $(".status_list");
      list.append(new Option('Select Status',''))
      $.each(result.data, function(index, item) {
      list.append(new Option(item.name, item.id));
      });
  }
});
}

