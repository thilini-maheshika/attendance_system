// // Wait for the DOM to load
// document.addEventListener('DOMContentLoaded', () => {
//     // Get all the buttons in the sidebar
//     const buttons = document.querySelectorAll('#myDIV button');
  
//     // Add an event listener to each button
//     buttons.forEach((button, index) => {
//       button.addEventListener('click', () => {
//         // Remove the 'active' class from all other buttons
//         buttons.forEach(button => {
//           button.classList.remove('active');
//         });
  
//         // Add the 'active' class to the clicked button
//         button.classList.add('active');
  
//         // Store the index of the active button in localStorage
//         localStorage.setItem('activeButtonIndex', index);
//       });
//     });
  
//     // Check if there is a value for the active button index in localStorage
//     const activeButtonIndex = localStorage.getItem('activeButtonIndex');
  
//     // If there is, add the 'active' class to the corresponding button
//     if (activeButtonIndex !== null) {
//       buttons[activeButtonIndex].classList.add('active');
//     }
//   });
  