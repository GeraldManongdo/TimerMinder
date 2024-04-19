<?php
include("backend/addtask.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--LINK FOR POPPINS FONT-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Noto+Sans:wdth,wght@62.5..100,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:wght@100..900&display=swap" rel="stylesheet"> 
<!--LINK FOR BOX ICON-->
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <link rel="stylesheet" href="asset/style.css">
<title>Fixed Side Navigation</title>
<style>
    section{
        height: 100vh;
    }
.carousel-container {
  position: relative;
 width: 100%;
  margin: 0 auto;
  overflow: hidden;
}

.carousel {
  display: flex;
  transition: transform 0.3s ease;
}

.page {
  flex: 0 0 auto;
  width: 100%;
  padding: 20px;
  display: flex;
  justify-content: center;
}
.card{
    background-color:#AF2213 ;
    margin: 10px;
    width: 400px;
    height: 600px;
    text-align: center;
    border-radius: 0;
    color: white;
}
.card img{
    background-color: white;
    margin-left: -10px;
    margin-top: -5px;
    margin-bottom: 40px;
    border: 1px solid black;
    width: 100%;
}
h4{
    font-weight: 800;
}

.prev-btn,
.next-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: #AF2213;
  color: white;
  border: none;
  padding: 10px 20px 0 20px ;
  border-radius: 50%;
  cursor: pointer;
  font-size: 50px;
}

.prev-btn {
  left: 10px;
}

.next-btn {
  right: 10px;
}
</style>
</head>
<body>
    <?php
    include("layout/navigation.php");
    include("layout/popup.php");
    ?>


<section>
        <div class="Second">
            <div class="aboutUsContainer">
                <div class="aboutUsContext">
                    <h2>ABOUT US</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quidem blanditiis sunt temporibus architecto quae sit doloribus, sequi quaerat alias, accusamus maiores ex tempora laboriosam voluptate, iste nihil repellendus fugiat. Deleniti, architecto! Possimus ex non reiciendis earum temporibus laboriosam voluptas repellat! Laborum rem ipsum commodi recusandae nihil corrupti harum repellendus. Reiciendis facere itaque tenetur sunt odio omnis expedita minima aliquid est at suscipit mollitia asperiores quisquam excepturi laboriosam, nesciunt illo architecto velit? Obcaecati iusto quam cumque nostrum quo provident nisi in consequatur exercitationem iure laboriosam architecto enim voluptatem fugit inventore ducimus omnis, ullam magnam quibusdam nam non dolore dignissimos aperiam.</p>
                </div>
                <div class="aboutUsImage"><img src="image/group.jpg" alt="" srcset=""></div>
            </div>


        </div>          
        
        <h1 class="second">MEET OUR TEAM!</h1>
        <div class="carousel-container">
            <div class="carousel">
              <div class="page">
                <div class="card">
                    <img src="image/ben-removebg-preview.png" alt="">
                    <h4>Benedick Casa</h4>
                    <span>Project Manager</span>
                </div>
                <div class="card">
                    <img src="image/gigi-removebg-preview (1).png" alt="">
                    <h4>Benedick Casa</h4>
                    <span>Project Manager</span>
                </div>
                <div class="card">
                    <img src="image/me-removebg-preview.png" alt="">
                    <h4>Benedick Casa</h4>
                    <span>Project Manager</span>
                </div>
              </div>
              <div class="page">
                <div class="card">
                    <img src="image/meri_arns-removebg-preview.png" alt="">
                    <h4>Benedick Casa</h4>
                    <span>Project Manager</span>
                </div>
                <div class="card">
                    <img src="image/kj-removebg-preview (1).png" alt="">
                    <h4>Benedick Casa</h4>
                    <span>Project Manager</span>
                </div>
                <div class="card">
                    <img src="image/kolin-removebg-preview.png" alt="">
                    <h4>Benedick Casa</h4>
                    <span>Project Manager</span>
                </div>
              </div>
              
            </div>
            <button class="prev-btn"><i class='bx bx-chevron-left' ></i></button>
            <button class="next-btn"><i class='bx bx-chevron-right'></i></button>
          </div>
        </section>


    <script src="asset/script.js"></script>
    <script src="asset/timer.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('.carousel');
        const pages = document.querySelectorAll('.page');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
      
        let counter = 0;
        const pageWidth = pages[0].offsetWidth;
      
        nextBtn.addEventListener('click', function() {
          if (counter < pages.length - 1) {
            counter++;
            carousel.style.transform = `translateX(-${counter * pageWidth}px)`;
          }
        });
      
        prevBtn.addEventListener('click', function() {
          if (counter > 0) {
            counter--;
            carousel.style.transform = `translateX(-${counter * pageWidth}px)`;
          }
        });
      });
    </script>

</body>
</html>
