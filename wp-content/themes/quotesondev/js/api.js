$(document).ready(function() {
  console.log(red_vars.rest_url);
  $('#new-quote-button').on('click', function() {
    $.ajax({
      method: "GET",
      url: `${red_vars.rest_url}wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1`
    }).done(result => {
      console.log(result);
      const source = result[0]._qod_quote_source;
      const sourceURL = result[0]._qod_quote_source_url;
      $('.entry-content').html(result[0].content['rendered']);
      $('.entry-title').html('— ' + result[0].title['rendered']);
      if (source) {
        $('.source').html((sourceURL) ? `, <a href='${sourceURL}'> ${source}</a>` : `,  ${source}`);
      } else {
        $('.source').html("");
      }
    });
  });

  $('#quoteSubmit').on('submit', function(event) {
   event.preventDefault();
   console.log("Form function started.");
   const data = $("#quoteSubmit :input").serializeArray();
   console.log(data);
   const author = data[0].value;
   const quote = data[1].value;
   const source = data[2].value;
   const sourceURL = data[3].value;

   $(".error").remove();
   let didFail = 0;

   if (!author) {
    $('#author').after('<span class="error">This field is required</span>');
    didFail = 1;
   }
   if (!quote) {
    $('#quote').after('<span class="error">This field is required</span>');
    didFail = 1;
   }
   if (sourceURL && !source) {
    $('#origin').after('<span class="error">Need to have a source for your quote to enter in a url.</span>');
    didFail = 1;
   }
   if (!didFail) {
     $.ajax({
        method: 'post',
        url: `${red_vars.rest_url}wp/v2/posts`,
        data: {
          'title':author,
          'status':'publish', // ok, we do not want to publish it immediately
          'content':quote,
          '_qod_quote_source':source,
          '_qod_quote_source_url':sourceURL
        },
        beforeSend: function(xhr) {
           xhr.setRequestHeader( 'X-WP-Nonce', red_vars.wpapi_nonce );
        }
     }).done( function(response) {
        $('.entry-content').html("<p>Success, your quote has been added!</p>");
     });
  }
  });
});