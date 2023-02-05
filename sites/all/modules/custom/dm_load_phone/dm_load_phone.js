/* Connecting this JS if you want include all pages. */
console.log('Connect dm load phone');
// function _phone(id, nid) {
//     const result = document.getElementById(`nid-${nid}`);
//
//     let url = `/getuphone?ajx=true&method=loadphone&nid=${nid}`;
//     result.classList.add('visible');
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", url);
//     xhr.onload = function (e) {
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             let response =JSON.parse(xhr.responseText);
//             console.log(' response = ', response);
//             let phone = response.data.phone;
//             if(phone){
//                 let replacePhone = phone.replace(/[^0-9]/g, '');
//                 result.textContent = '';
//                 result.textContent = `+${replacePhone}`;
//
//                 result.setAttribute('href', `tel:${replacePhone}`);
//             }
//             else{
//                 result.textContent = 'Phone is empty';
//             }
//
//         }
//     };
//     xhr.send(null);
// }
