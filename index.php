<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootswatch: Slate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <script>

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>

    <?php
      require 'xkcdpasswd.php';
      ?>

  </head>

  <body>
    
    <div class="container">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>xkcd Password Generator</h1>
            <p class="lead">Shades of gunmetal gray</p>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
          </div>
        </div>
      </div>

      <!-- Typography
      ================================================== -->
      <div class="bs-docs-section">
        <!-- Headings -->

        <div class="row">
          <div class="col-lg-14">
              <h2>Web App Description</h2>
                <p class="text-warning">  This web application implements the xkcd password generation function as described by various websites using PHP as the backend language
                                          and HTML/CSS for the front end language for the form input/parameters and display of generated passwords.</p>
                <h3>Bootstrap</h3>
                  <p class="text-info">   A simple, single flat page was employed using the following free bootstrap template designed by Thomas Park with the source URL located here
                                          <a href="http://bootswatch.com/slate/">Slate Bootswatch Theme</a>. The free theme looked contemporary and the form inputs were very appealing
                                          for this assignment.</p>
                <h3>Form Inputs</h3>
                  <p class="text-danger"> Initially, I used &lt;select&gt; dropdown input methods to select the number of words and number but as it forced them inputs as integer, I changed
                                          to text input to implement some error checking functionality. I also removed default checked values for the radio buttons again to implement the error
                                          checking functionality.</p>

                <h3>Wordlist</h3>
                  <p class="text-danger"> To simplify the code, I removed apostrophes from words in wordlist as it was causing errors. Removed 20 words.
https://github.com/first20hours/google-10000-english
          </div>
        </div>
      </div>

      <!-- Forms
      ================================================== -->
      <div class="bs-docs-section">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="forms">Let's Generate Some Passwords!!</h1>
            </div>
          </div>
        </div>


    <?php
      $NumWordsErr = $NumNumsErr = $SpecialCharsErr = $CapFirstLetterErr = $SeparatorErr = "";
      $NumWords = $NumNums = $SpecialChars = $CapFirstLetter = $Separator = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["NumWords"])) {
          $NumWordsErr = "NumWords is required";
        } else {
          $NumWords = test_input($_POST["NumWords"]);
          
          if (!preg_match('/^[0-9]{0,1}$/',$NumWords)) {
            $NumWordsErr = "Only digits 0-9 allowed";
          } else {
            $NumWordsErr = "";
          }
        }

        if (empty($_POST["NumNums"])) {
          $NumNumsErr = "Email is required";
        } else {
          $NumNums = test_input($_POST["NumNums"]);
        }
        if (empty($_POST["SpecialChars"])) {
          $SpecialCharsErr = "* Must Choose Yes or No";
        } else {
          $SpecialChars = test_input($_POST["SpecialChars"]);
        }
        
        if (empty($_POST["Separator"])) {
          $SeparatorErr = "Email is required";
        } else {
          $Separator = test_input($_POST["Separator"]);
        }


        if (empty($_POST["CapFirstLetter"])) {
          $CapFirstLetterErr = "* Must Choose Yes or No";
        } else {
          $CapFirstLetter = test_input($_POST["CapFirstLetter"]);
        }
            echo $SpecialChars;
    echo $CapFirstLetter;
      }

        function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data; }

         $Password1 = "horse-magnet-ant";
         $Password2 = "horse-magnsdet-ansdfsdfst";
         $Password3 = "1234! 34343 skdfer";
         $Password4 = "poop-doop-floop";
    ?>

    
        <div class="row">
          <div class="col-lg-6">
            <div class="well-password">
              <form method="post" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset>
                  <legend>Password Parameters</legend>

                  <div class="form-group">
                    <label for="select1" class="col-lg-4 control-label">Number of Words</label>
                    <div class="col-lg-3">
                      <select class="form-control" id="select1" name="NumWords" value="<?php echo $NumWords;?>">
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-4 control-label">Word Length</label>
                    <div class="col-lg-3">
                      <select class="my-form-control" id="WordMin" name="WordLengthMin" value="<?php echo $NumWords;?>">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                      </select>
                      <label for="WordMin" class="col-lg-offset-4">Min</label>
                    </div>
                    <div class="col-lg-3 col-lg-offset-2">
                      <select class="my-form-control" id="WordMax" name="WordLengthMax" value="<?php echo $NumWords;?>">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                      </select>
                      <label for="WordMax" class="col-lg-offset-4">Max</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="select3" class="col-lg-4 control-label">Number of Numbers</label>
                    <div class="col-lg-3">
                      <select class="form-control" id="select3" name="NumNums" value="<?php echo $NumNums;?>">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="SpecialChars" class="col-lg-4 control-label">Special Characters?</label>
                    <label for="Separator" class="col-lg-3 col-lg-offset-5 control-label">Separator?</label>
                    <div class="col-lg-6">
                      <div class="radio">
                        <label>
                          <input type="radio" id="SpecialChars" name="SpecialChars" <?php echo $SpecialChars; if (isset($SpecialChars) && $SpecialChars=="Yes") echo "checked";?> value="Yes">
                          Yes
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="SpecialChars" name="SpecialChars" <?php echo $SpecialChars; if (isset($SpecialChars) && $SpecialChars=="No") echo "checked";?>value="No">
                          No
                        </label>
                        <span class="error"> <?php echo  $SpecialCharsErr;?></span>
                      </div>
                    </div>
                      <div class="col-lg-3 col-lg-offset-3">
                        <select class="my-form-control" id="Separator" name="Separator" value="<?php echo $Separator;?>">
                          <option>-</option>
                          <option></option>
                          <option>_</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-4 control-label">Capitalize First Letter?</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" id="CapFirstLetter" name="CapFirstLetter" <?php echo $CapFirstLetter; if (isset($CapFirstLetter) && $CapFirstLetter=="Yes") echo "checked";?> value="Yes">
                          Yes
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" id="CapFirstLetter" name="CapFirstLetter" <?php echo $CapFirstLetter; if (isset($CapFirstLetter) && $CapFirstLetter=="No") echo "checked";?> value="No">
                          No
                        </label>
                        <span class="error"> <?php echo $CapFirstLetterErr;?></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="well-password">

                <legend>Password Outputs<legend>
                <br>
                <div class="form-group">
                  <label class="control-label">Password 1</label>
                  <input type="text"  class="form-control" id="inputDefault" value ="<?php print_r(generate_password($NumWords,$Separator)); ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Password 2</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php print_r(generate_password($NumWords,$Separator)); ?>">
                </div>

                <div class="form-group">
                  <label>Password 3</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php print_r(generate_password($NumWords,$Separator)); ?>">
                </div>

                <div class="form-group">
                  <label>Password 4</label>
                  <input type="text" class="form-control" id="inputDefault" value ="<?php print_r(generate_password($NumWords,$Separator)); ?>">
                </div>

            </div>
          </div>
        </div>
      </div>
      <pre>
      <?php
      echo $NumWords;
      echo $Separator;
      $passout=generate_password($NumWords,$Separator);
      print_r($passout);
      ?>
    </pre>


      <footer>
        <div class="row">
          <div class="col-lg-12">

            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
              <li><a href="http://news.bootswatch.com" onclick="pageTracker._link(this.href); return false;">Blog</a></li>
              <li><a href="http://feeds.feedburner.com/bootswatch">RSS</a></li>
              <li><a href="https://twitter.com/bootswatch">Twitter</a></li>
              <li><a href="https://github.com/thomaspark/bootswatch/">GitHub</a></li>
              <li><a href="../help/#api">API</a></li>
              <li><a href="../help/#support">Support</a></li>
            </ul>
            <p>Made by <a href="http://thomaspark.me" rel="nofollow">Thomas Park</a>. Contact him at <a href="mailto:thomas@bootswatch.com">thomas@bootswatch.com</a>.</p>
            <p>Code released under the <a href="https://github.com/thomaspark/bootswatch/blob/gh-pages/LICENSE">MIT License</a>.</p>
            <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

          </div>
        </div>

      </footer>


    </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="bootswatch.js"></script>
  </body>
</html>
