$(function () {
   let currentItems = 2;
   $(document).on('click', '#loadmore', function(){
         const elementList = [...document.querySelectorAll('.list .number-block')];
            for (let i = currentItems; i < currentItems + 4; i++) {
                  if (elementList[i]) {
                     elementList[i].style.display = 'block';
                  }
            }
            currentItems += 2;
         
            // Load more button will be hidden after list fully loaded
            if (currentItems >= elementList.length) {
                  event.target.style.display = 'none';
            }
   });
});