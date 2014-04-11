eventListener(window, 'load', init);
var survey;

function init() {
    var links = document.querySelectorAll('.btn-create-question'),
        form = document.getElementById('SurveyAddForm');
        //deadlineFlag = document.getElementById('disable-deadline');

    for(var i = 0; i < links.length; i++) {
        eventListener(links[i], 'click', handleClick);
    }


    //eventListener(deadlineFlag, 'click', changeDeadline);
    survey = new Survey();
    return false;
}

function eventListener(element, event, callback) {
    if ('addEventListener' in window) {
        element.addEventListener(event, callback, false);
    } else {
        element.attachEvent('on' + event, callback);
    }
    return false;
}

function handleClick(e) {
    e.preventDefault();
    var type = this.getAttribute('id');
    survey.addQuestion(type.replace('-question', ''));
    return false;
}

function changeDeadline(e) {
    var deadline = document.getElementById('deadline');

    if (this.checked) {
        deadline.disabled = true;
        deadline.value = null;
        deadline.setAttribute('value', '');
    } else {
        deadline.disabled = false;
    }
    return false;
}

/** Survey builder **/
function Survey() {
    this.counter = $('#survey-forms div.survey-question').size();
    this.parent = document.getElementById('survey-forms');
    return false;
    
}

Survey._removeParent = function(e) {
    this.parentElement.remove();
    return false;
}

Survey.prototype = {
    addQuestion: function(type) {
        var question = document.createElement('div');
        question.className = 'survey-question';

        var label = document.createElement('label');
        label.htmlFor = 'title-' + this.counter;
        label.innerText = 'Question';
        question.appendChild(label);

        var input = document.createElement('input');
        input.className = 'input-block-level';
        input.id = 'title-' + this.counter;
        //input.name = 'data[' + this.counter + '][Question][description]';
        input.name = 'data[Questions][' + this.counter + '][description]';
        input.type = 'text';
        question.appendChild(input);

        input = document.createElement('input');
        input.name = 'data[Questions][' + this.counter + '][type]';
        input.type = 'hidden';
        input.value = type;
        question.appendChild(input);
        
        //question.appendChild(document.createElement('br'));

        switch (type) {
            case 'essay':
                //this._newEssay(question);
                break;
            case 'likert-scale':
                //this._newLikertScale(question);
                break;
            case 'multiple-choice':
                this._newMultipleChoice(question, 'checkbox');
                break;
            case 'single-choice':
                this._newMultipleChoice(question, 'radio');
                break;
            default:
                //this._newEssay(question);
                break;
        }

        var icon = document.createElement('i');
        icon.className = 'fa fa-trash-o';

        var removeBtn = document.createElement('button');
        removeBtn.className = 'alert'//'btn btn-danger btn-remove';
        //removeBtn.type = 'button';
        removeBtn.appendChild(icon);
        question.appendChild(removeBtn);

        eventListener(removeBtn, 'click', Survey._removeParent);

        this.parent.appendChild(question);
        this.counter++;
    },
    newOption: function(questionId, type, newOp) {
        var option = document.createElement('div');

        option.className = type + '-prototype row collapse';

        /*var input = document.createElement('input');
        //input.disabled = true;
        input.type = type;
        option.appendChild(input);
        */
        if(newOp) {
            option.appendChild(document.createTextNode(' '));
            var holder = document.createElement('div');
            holder.className = "large-10 columns";

                input = document.createElement('input');
                input.name = 'data[Questions][' + questionId + '][Answer][][description]';
                input.placeholder = 'Option';
                input.type = 'text';

            holder.appendChild(input);
            option.appendChild(holder);
        } else {
            input = document.createElement('input');
            input.name = 'data[Questions][' + questionId + '][Answer][][description]';
            input.placeholder = 'Option';
            input.type = 'text';
            option.appendChild(input);
        }
        return option;
    },
    _insertOption: function(e) {
        var parent = this.parentElement,
            id = this.getAttribute('data-question'),
            type = this.getAttribute('data-type'),
            option = survey.newOption(id, type, true);

        var icon = document.createElement('i');
        icon.className = 'fa fa-trash-o';

        var holder2 = document.createElement('div');
        holder2.className = 'large-2 columns';

        var button = document.createElement('button');
        button.className = 'alert';//'btn btn-rmv-option';
        button.type = 'button';
        button.appendChild(icon);
        
        holder2.appendChild(button);
        option.appendChild(holder2);

        eventListener(button, 'click', Survey._removeParent);

        parent.insertBefore(option, this);

        return false;
    },
    _newEssay: function(div) {
        var textarea = document.createElement('textarea');
        textarea.className = 'input-block-level';
        //textarea.disabled = true;
        textarea.rows = 5;
        div.appendChild(textarea);
    },
    _newLikertScale: function(div) {
        var label, input, text;

        for (var i = 1; i <= 5; i++) {
            label = document.createElement('label');
            label.className = 'radio inline';

            input = document.createElement('input');
            //input.disabled = true;
            input.type = 'radio';

            text = document.createTextNode(' ' + i);
            label.appendChild(input);
            label.appendChild(text);

            div.appendChild(label);
        }

        div.appendChild(document.createElement('br'));
    },
    _newMultipleChoice: function(div, type) {
        for (var i = 0; i < 2; i++) {
            div.appendChild(this.newOption(this.counter, type, false));
        }

        var button = document.createElement('button');
        button.className = 'btn btn-primary btn-options';
        button.type = 'button';
        button.setAttribute('data-type', type);
        button.setAttribute('data-question', this.counter);

        var icon = document.createElement('i');
        icon.className = 'fa fa-plus';
        button.appendChild(icon);
        button.appendChild(document.createTextNode(' Option'));

        eventListener(button, 'click', this._insertOption);
        div.appendChild(button);
    }
};

// jQuery
$(document).ready(function() {
});