  $(".qno-selector").change(function(e){
    e.preventDefault();
    $(".panel-body").html("<div class='row text-center loading-block'><img src='"+loadingImg+"'></div>");

    qNo = $(e.target).val();
    readQuest();
  });
  $(".prevQuest").click(function(e)
  {
    e.preventDefault();
    if(qNo==1)
    {
      return;
    }

    $(".panel-body").html("<div class='row text-center loading-block'><img src='"+loadingImg+"'></div>");
    
    qNo--;
    readQuest();
    $(".qno-selector").val(qNo);
  });

  $(".nextQuest").click(function(e)
  {
    e.preventDefault();
    if(qNo==maxQuestions)
    {
      return;
    }

    $(".panel-body").html("<div class='row text-center loading-block'><img src='"+loadingImg+"'></div>");

    qNo++;
    readQuest();
    $(".qno-selector").val(qNo);
  });

  function readQuest()
  {
    $.ajax(
    {
      method:'post',
        url : readUrl,
        data : {_token:token,exam_id:examID,order:qNo}
    }
    ).done(function(data){
      //console.log(data['content']);
      $(".loading-block").remove();
      $(".panel-body").html(data);
      $(".remove-answer").click(removeAns);
        $(".answer-type").change(changeType);
        $(".add-answer").click(addAnswer);
        $("form").submit(submit);
        selection = $(".answer-type").val();
        answersCount =$("form .ansCount").val();
    });

    
  }

  $(".remove-answer").click(removeAns);
  $(".answer-type").change(changeType);
    $(".add-answer").click(addAnswer);
  $("form").submit(submit);
  function changeType(e) {
     //console.log($(e.target).val())
     selection = $(e.target).val();
     if(selection == 1)
     {
      //console.log("radio");
      //console.log($(":checkbox"));
      var elements =$(":checkbox");
      for(var i=0 ; i <elements.length ; i++)
      {
        $(elements[i]).attr({
          'type':'radio',
          'name' :'ans',
          'value':'ans'+(i+1),
        });
      }

     }
     else
     {
      //console.log("checkbox");
      var elements =$(":radio");
      for(var i=0 ; i <elements.length ; i++)
      {
        $(elements[i]).attr({
          'type':'checkbox',
          'name' :'ans'+(i+1),
          'value':'yes',
        });
      }
        
      
     }
     
  }

  function addAnswer(e) {
    e.preventDefault();
    answersCount++;
    //console.log(e);
    if(selection==1)
    {
      $(".answers-block").append("<div class='form-group single-answer'><div class='col col-md-1'><input type='radio' name='ans' class='checkbox' value='ans"+answersCount+"'></div><div class='col col-md-10'><input type='text' name='ansContent"+answersCount+"' class='form-control'></div><a href='#' class='btn btn-danger remove-answer btn-sm'><i class='fa fa-trash-o'></i></a></div>");
    }
    else
    {
      $(".answers-block").append("<div class='form-group single-answer'><div class='col col-md-1'><input type='checkbox' name='ans"+answersCount+"' class='checkbox' value='yes'></div><div class='col col-md-10'><input type='text' name='ansContent"+answersCount+"' class='form-control'></div><a href='#' class='btn btn-danger remove-answer btn-sm'><i class='fa fa-trash-o'></i></a></div>");
    }

    $(".remove-answer").bind('click',removeAns);
    
  }

  function removeAns(e)
  {
    e.preventDefault();
    $(e.target).parent().remove();
    answersCount--;
    //console.log(e);
  }
  
  function submit(e){
    e.preventDefault();
    if(validateQuestion())
    {
      var question = $("textarea").val();
      //console.log(qNo);
      var ansType = (selection==2);//is multiple or not
      var ansCount =answersCount;
      var answers = new Array();
      var allAnswers_txt= $(".answers-block :text");
      var select = (selection==1?".answers-block :radio":".answers-block :checkbox");
      var allAnswers_choice= $(select);
      console.log(allAnswers_choice);
      //console.log(allAnswers_txt);

      for(var i=0 ; i<ansCount ; i++)
      {
        var cont = $(allAnswers_txt[i]).val();
        var status = allAnswers_choice[i].checked;
        //console.log(allAnswers_choice[i].checked);
        var ans = new answer(cont,status);
        answers[i] = ans;

      }
      //console.log(answers);
      
      $.ajax({
        method:'post',
        url : storUrl,
        data : {_token:token,exam_id:examID,order:qNo,content:question ,answerType:ansType ,answersCount:ansCount ,allAnswers:answers}
      }).done(function(data){
        //console.log(msg['test']);
        //console.log(msg['htm']);
        //$('.panel-body').append(msg['htm']);
        alert(data['msg']);
      });
    }

  }

  function answer(content,status)
  {
    this.content = content;
    this.status = status;
  }

  function validateQuestion()
  {
    //validatio flag
    var isRight=true;
    //check quesiton content
    var question = String($("textarea").val());

    $("form span").remove();
    //console.log(question);

    $("textarea").parent().removeClass('has-error');
    $("textarea").parent().removeClass('has-success');
    if(question=="")
    {
      //console.log("add quesion first");
      $("textarea").parent().addClass("has-error");
      $("textarea").after("<span class='text-danger'>add question first</span>");
      isRight=false;
    }
    else if(question.length <10)
    {
      $("textarea").parent().addClass("has-error");
      $("textarea").after("<span class='text-warning'>question is too short</span>");
      isRight=false;
    }
    else
    {
      $("textarea").parent().addClass("has-success");
    }

    //validate answers input
    var answers = $(".answers-block :text");

    for(var i=0 ;i<answers.length ; i++)
    {
      var tmpValue = $(answers[i]).val();
      $(answers[i]).parent().removeClass('has-error');
        $(answers[i]).parent().removeClass('has-success');

      if(tmpValue=="")
      {
        $(answers[i]).parent().addClass("has-error");
      isRight=false;
      $(answers[i]).after("<span class='text-danger'>answer is empty</span>");
      }
      else
      {
        $(answers[i]).parent().addClass("has-success");
      }
    }

    //validate right answers
    var ans;
    console.log("selection = "+selection);
    if(selection==1)
    {
      ans = $(".answers-block :radio:checked");
    }
    else
    {
      ans = $(".answers-block :checkbox:checked");
    }
    //console.log(ans);
    if(ans.length ==0)
    {
      isRight = false;
      $(".answers-block").prepend("<span class='text-danger'>choose at least one right answer</span>");
    }
    return isRight;
  }