<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Quiz - CP Club</title>
    <link rel="stylesheet" href="./Quiz.css">
    <link rel="icon" href="../assets/Images/12.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="info_box">
        <div class="info-title"><span>Some Rules of this Quiz</span></div>
        <div class="info-list">
            <div class="info"><b>1.</b> Your Name Shown on the leader board basis of your no. of correct answers.</div>
            <div class="info"><b>2.</b> If two players have same points then time taken to select the correct answer will be taken under considerataion.</div>
        </div>
        <div class="buttons">
            <a href="../HTML/Dashboard.html"><button class="quit">Exit Quiz</button></a>
            <button class="restart">Continue</button>
        </div>
    </div>

    <div class="quiz_box">
        <header>
            <div class="title">Awesome Quiz Application</div>
            <div class="timer">
                <div class="time_left_txt">Time Taken</div>
                <div class="timer_sec">00</div>
            </div>
            <div class="time_line"></div>
        </header>
        <section>
            <div class="que_text"></div>
            <div class="option_list"></div>
        </section>
        <footer>
            <div class="total_que"></div>
            <button class="next_btn">Submit</button>
        </footer>
    </div>

    <div class="result_box">
        <div class="complete_text"><b>You've completed the Quiz!</b></div>
        <div class="score_text"></div>
        <div class="buttons">
            <a href="../HTML/Dashboard.html"><button class="quit">Quit Quiz</button></a>
        </div>
    </div>

    <?php
    require("../includes/dbh.inc.php");
    $today = date("Y-m-d");
    $sql = "SELECT * FROM `questions` WHERE Show_Date = '$today'";
    $result = mysqli_query($link, $sql);


    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $jsonData = json_encode($row);
    } else {
        $jsonData = json_encode((object)[]);
    }

    ?> ;
    <script>
        let questions = JSON.parse(JSON.stringify(<?php echo $jsonData ?>));
        const start_btn = document.querySelector(".start_btn button");
        const info_box = document.querySelector(".info_box");
        const exit_btn = info_box.querySelector(".buttons .quit");
        const continue_btn = info_box.querySelector(".buttons .restart");
        const quiz_box = document.querySelector(".quiz_box");
        const result_box = document.querySelector(".result_box");
        const option_list = document.querySelector(".option_list");
        const time_line = document.querySelector("header .time_line");
        const timeText = document.querySelector(".timer .time_left_txt");
        const timeCount = document.querySelector(".timer .timer_sec");
        info_box.classList.add("activeInfo");

        continue_btn.onclick = () => {
            info_box.classList.remove("activeInfo");
            quiz_box.classList.add("activeQuiz");
            showQuestions(0);
            queCounter(1);
            startTimer(0);
            startTimerLine(0);
        };

        let timeValue = 0;
        let que_count = 0;
        let que_numb = 1;
        let userScore = 0;
        let counter;
        let counterLine;
        let widthValue = 0;

        const quit_quiz = result_box.querySelector(".buttons .quit");

        const next_btn = document.querySelector("footer .next_btn");
        const bottom_ques_counter = document.querySelector("footer .total_que");

        next_btn.onclick = () => {
            if (que_count < questions.length - 1) {
                que_count++;
                que_numb++;
                showQuestions(que_count);
                queCounter(que_numb);
                clearInterval(counter);
                clearInterval(counterLine);
                startTimer(timeValue);
                startTimerLine(widthValue);
                timeText.textContent = "Time Left";
                next_btn.classList.remove("show");
            } else {
                clearInterval(counter);
                clearInterval(counterLine);
                showResult();
            }
        };

        function showQuestions(index) {
            const que_text = document.querySelector(".que_text");

            let que_tag = '<span>' + questions.Question_ID + ". " + questions.Question + '</span>';
            let option_tag = '<div class="option"><span>' + questions.Option_A + '</span></div>' +
                '<div class="option"><span>' + questions.Option_B + '</span></div>' +
                '<div class="option"><span>' + questions.Option_C + '</span></div>' +
                '<div class="option"><span>' + questions.Option_D + '</span></div>';
            que_text.innerHTML = que_tag;
            option_list.innerHTML = option_tag;

            const option = option_list.querySelectorAll(".option");

            for (let i = 0; i < option.length ; i++) {
                option[i].setAttribute("onclick", "optionSelected(this)");
            }
        }

        let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
        let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

        function optionSelected(answer) {
            clearInterval(counter);
            clearInterval(counterLine);
            let userAns = answer.textContent;
            let correctAns = questions.Correct_Ans;
            const allOptions = option_list.children.length;

            if (userAns == correctAns) {
                userScore += 1;
                answer.classList.add("correct");
                answer.insertAdjacentHTML("beforeend", tickIconTag);
                console.log("Correct Answer");
                console.log("Your correct answers = " + userScore);
            } else {
                answer.classList.add("incorrect");
                answer.insertAdjacentHTML("beforeend", crossIconTag);
                console.log("Wrong Answer");

                for (let i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correctAns) {
                        option_list.children[i].setAttribute("class", "option correct");
                        option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag);
                        console.log("Auto selected correct answer.");
                    }
                }
            }

            for (let i = 0; i < allOptions; i++) {
                option_list.children[i].classList.add("disabled");
            }
            next_btn.classList.add("show");
        }

        function showResult() {
            info_box.classList.remove("activeInfo");
            quiz_box.classList.remove("activeQuiz");
            result_box.classList.add("activeResult");
            const scoreText = result_box.querySelector(".score_text");

            let scoreTag = "";
            if (userScore >= 1) {
                scoreTag = `<span> <b>Congratulations !</b> Your answer is <b>Correct</b> and You Had Taken <div id="time">${timeCount.textContent}</div> seconds.</span>`;
            } else {
                scoreTag = `<span> <b>Better Luck Next Time !</b> Your answer is <b>In-Correct</b> and You Had Taken <div id="time">${timeCount.textContent}</div> seconds.</span>`;
            }

            scoreText.innerHTML = scoreTag;
        }

        function startTimer(time) {
            counter = setInterval(timer, 1000); // update the time every 100 milliseconds for smoother display

            function timer() {
                time++;
                if (time > 15) {
                    clearInterval(counter);
                    timeText.textContent = "Time Off";
                    const allOptions = option_list.children.length;
                    let correcAns = questions.Correct_Ans;
                    for (let i = 0; i < allOptions; i++) {
                        if (option_list.children[i].textContent == correcAns) {
                            option_list.children[i].setAttribute("class", "option correct");
                            option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag);
                            console.log("Time Off: Auto selected correct answer.");
                        }
                    }
                    for (let i = 0; i < allOptions; i++) {
                        option_list.children[i].classList.add("disabled");
                    }
                    next_btn.classList.add("show");
                }
                timeCount.textContent = time;
                if (time < 10) {
                    timeCount.textContent = "0" + time;
                }
            }
        }

        time_line.style.width = "100%";

        function startTimerLine(time) {
            counterLine = setInterval(timer, 1000);

            function timer() {
                time += 1;
                if (time > 300) {
                    clearInterval(counterLine);
                    showResult();
                }
            }
        }

        function queCounter(index) {
            let totalQueCounTag = '<span><p>' + index + '</p> of <p>' + 1 + '</p> Questions</span>';
            bottom_ques_counter.innerHTML = totalQueCounTag;
        }
    </script>
</body>

</html>