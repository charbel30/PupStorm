// Select the sidebar toggle button
const sidebarToggle = document.querySelector("#toggle-sidebar");
// Create an array of states for the project
const projectStates = [{ showSideBar: true }];
// Select all the sections in the HTML page
const contentSections = document.querySelectorAll(".app-content > section");
// Select all the navbar items in the HTML page
const navbarItemsLi = document.querySelectorAll("#app-sidebar ul li");
// Create an array of objects to store the sections positions in the HTML page
const sectionsPositions = [];
// Select all the buttons in the HTML page
let navbutton = document.querySelectorAll(" .sidebut");
const date_time = document.querySelector(".date_time");

const mql = window.matchMedia("(max-width: 768px)");
const date = new Date();
// Create a timeout variable to store the timeout function
let refreshPositionsTimeout = null;
mainContainer = document.querySelector(".main-container");

const form = document.querySelector(".choose-form");
const end_message = document.querySelector(".end-message");
const genderError = document.getElementById('gender-error');
const emailError = document.getElementById('email-error');

const emailregex = (/^[^\s@]+@[^\s@]+\.[^\s@]+$/) ;



  //  display the date and time in the HTML page and update it every second 
  function clockTick() {
      const currentTime = new Date();
      let options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "numeric",
        second: "numeric",
        hour12: false,
      };
      var text = currentTime.toLocaleString("en-US", options);
      date_time.innerHTML = text;  
  }
  clockTick();
  // here we run the clockTick function every 1000ms (1 second)
  setInterval(clockTick, 1000);

  // Create a function to refresh the sections positions in the HTML page
  const handleRefreshPositions = (timeout = 500) => {
    // Clear the timeout to stop the function from being called multiple times
    refreshPositionsTimeout && clearTimeout(refreshPositionsTimeout);

    // Set a timeout for the function to be called
    refreshPositionsTimeout = setTimeout(() => {
      // Loop through the sections positions array
      sectionsPositions.forEach((sec, index) => {
        // Select the section in the HTML page
        const element = document.querySelector(`#${sec.id}`);
        // Get the position of the section in the HTML page
        const rect = element.getBoundingClientRect();
        // Update the position of the section in the HTML page
        sectionsPositions[index].pos = rect.top + window.scrollY;
      });
    }, timeout);
  };

  // Add an event listener to the sidebar toggle button to toggle the sidebar
  sidebarToggle.addEventListener("click", () => {
    // Select the sidebar element in the HTML page
    const sidebarElement = document.querySelector("#app-sidebar");
    // Select the main container element in the HTML page
    const mainContainer = document.querySelector(".main-container");
    // Get the state of the sidebar
    const { showSideBar } = projectStates[0];

    // If the sidebar is shown, hide it
    if (showSideBar) {
      sidebarElement.classList.remove("showed");
      mainContainer.style.width = "92%";
      // If the sidebar is not shown, show it
    } else {
      sidebarElement.classList.add("showed");
      mainContainer.style.width = "calc(100% - 20vw)";
    }
    // Update the state of the sidebar
    projectStates[0].showSideBar = !projectStates[0].showSideBar;
    // Save the state of the sidebar in the local storage
    localStorage.setItem("sidebarState", projectStates[0].showSideBar);
  });

  // Set the height of the main container to 100vh
  mainContainer.style.height = "100vh";
  // Set the overflow of the main container to auto
  mainContainer.style.overflow = "auto";

  // Loop through the buttons
  navbutton.forEach((item) => {
    // Add an event listener to the buttons to add a random animation time to them
    item.addEventListener("mouseover", (e) => {
      // Select a random number
      let time = Math.random();
      // Add the random number as the animation time for the button
      item.style.setProperty("--animation-time", time - 0.26 + "rem");
    });
  });





if(document.querySelector(".find-pup")){

form.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const type = formData.get("pet");
    const breed = formData.get("breed");
    const age = formData.get("age");
    const gender = formData.get("gender");
   let friendly = formData.get("friendly");

   //check if the friendly is null or not  then set it to no
    if(friendly === null){
      friendly = "No";
    }
 

   if(gender === null){
      genderError.style.display = 'block';
      document.querySelector("#end-message").style.display = 'none';
  
    } 
    else{
        genderError.style.display = 'none';
        document.querySelector(".main-container .find-pup").style.display = 'none';

        document.querySelector(".main-container .available-pets").style.display  = 'block';
     document.querySelector("#end-message").style.display = 'block';
     
    }
  
    const pet = {
      type,
      breed,
      age,
      gender,
      friendly,
    };

    console.log(pet);
  }
  );

  form.addEventListener("reset", (e) => {
    end_message.style.display = 'none';
    form.reset();
  }
  );
}
else if(document.querySelector(".giveaway")){
  form.addEventListener("submit", (e) => {
      e.preventDefault();
      const formData = new FormData(form);
      const type = formData.get("pet");
      const breed = formData.get("breed");
      const age = formData.get("age");
      const gender = formData.get("gender");
     let friendly = formData.get("friendly");
     let  childFriendly = formData.get("childFriendly");
     const name = formData.get("name");
      const email = formData.get("email");
      const comment = formData.get("comment");

  
     //check if the friendly is null or not  then set it to no
      if(friendly === null){
        friendly = "No";
      }
      if(childFriendly === null){
        childFriendly = "No";
      }
      console.log(email);

        if(!emailregex.test(email)){
        emailError.style.display = 'block';
        end_message.style.display = 'none';
        return;
      }
      else{
        emailError.style.display = 'none';
        form.style.display = 'none';
        document.querySelector(".donates").style.display = "none";
        end_message.style.display = 'flex';
    
      } 
      const pet = {
        type,
        breed,
        age,
        gender,
        friendly,
        childFriendly,
        name,
        email,
        comment

      };
  
      console.log(pet);
    }
    );

  
    form.addEventListener("reset", (e) => {
      end_message.style.display = 'none';
      emailError.style.display = 'none';
      form.reset();
    }
    );
  }
  