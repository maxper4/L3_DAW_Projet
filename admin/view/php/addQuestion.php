<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Quiz</title>    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="newquiz.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200&display=swap');
        </style>
    </head>
    
    <body>
        <div class="quiz">
            <form action="ValidateQuestion.php" method="get">
            <div class="question">
                <input id="chapter" name="idchapter" placeholder="Entrez l'id du chapitre" pattern="[1-9]" value="<?php echo $_GET['id']; ?>" type="hidden" readonly="readonly""/>
</br>
                <label>Entrez votre question : </label>
                <input id="question" name="question" type=text placeholder="Entrez votre question"/>
</br>
                <label>Entrez la difficulte : </label>
                <input id="Difficulty" name="difficulté" type=text placeholder="Entrez la difficulté" pattern="[1,2,3]" maxlength="1" />
</br>
                <label>Entrez la bonne reponse :
                <input id="GoodChoice" name="answer" type="text" placeholder="Entrez le choix de la bonne reponse" pattern="[1-4]" maxlength="1"/>
                <div class="choice">
                    <div class="choice-container">
                        <p class="choice-prefix">1.</p>
                        <input class="choice-text" id="1" type="text" placeholder="Entrez le choix 1" name="choice1"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">2.</p>
                        <input class="choice-text" id="2" type="text" placeholder="Entrez le choix 2" name="choice2"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">3.</p>
                        <input class="choice-text" id="3" type="text" placeholder="Entrez le choix 3" name="choice3"/>
                    </div>
                    <div class="choice-container">
                        <p class="choice-prefix">4.</p>
                        <input class="choice-text" id="4" type="text" placeholder="Entrez le choix 4" name="choice4"/>
                    </div>
                        <input class="choice-valid" id="validate" type="submit" value="Valider votre question" />
                    
                </div>
            </div>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </body>

</html> 