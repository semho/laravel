'use strict';

document.addEventListener('DOMContentLoaded', function () {
    function translit(word){
        var converter = {
            'а': 'a',    'б': 'b',    'в': 'v',    'г': 'g',    'д': 'd',
            'е': 'e',    'ё': 'e',    'ж': 'zh',   'з': 'z',    'и': 'i',
            'й': 'y',    'к': 'k',    'л': 'l',    'м': 'm',    'н': 'n',
            'о': 'o',    'п': 'p',    'р': 'r',    'с': 's',    'т': 't',
            'у': 'u',    'ф': 'f',    'х': 'h',    'ц': 'c',    'ч': 'ch',
            'ш': 'sh',   'щ': 'sch',  'ь': '',     'ы': 'y',    'ъ': '',
            'э': 'e',    'ю': 'yu',   'я': 'ya'
        };

        word = word.toLowerCase();

        var answer = '';
        for (var i = 0; i < word.length; ++i ) {
            if (converter[word[i]] == undefined){
                answer += word[i];
            } else {
                answer += converter[word[i]];
            }
        }

        answer = answer.replace(/[^-0-9a-z]/g, '-');
        answer = answer.replace(/[-]+/g, '-');
        answer = answer.replace(/^\-|-$/g, '');
        return answer;
    }

    const inputSlug = document.getElementById('inputSlug');
    const inputName= document.getElementById('inputName');
    if (inputName) {
        inputName.addEventListener('input', () => {
            inputSlug.value = translit(inputName.value);
        });
    }


    const formReport = document.getElementById('formReport');
    if (formReport) {
        formReport.addEventListener('submit', sendReport);
    }
});

async function sendReport() {
    event.preventDefault();
    const data = {
        news: document.getElementById('news').checked,
        articles: document.getElementById('articles').checked,
        comments: document.getElementById('comments').checked,
        tags: document.getElementById('tags').checked,
        users: document.getElementById('users').checked,
    };
    const response = await fetch('/admin/reports_total', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify(data)
    });

    //получаем ответ
    const result = await response.json();
    removeMessage();

    //обработка ответа
    if (result.success) {
       createReport();
    } else if (result.message) {
        messageWarning(result.message);
    } else {
        messageWarning('ошибка запроса');
    }

}

function createReport() {
    document.getElementById('formReport').remove();
    const report = document.createElement('div');
    report.classList.add(
        'report',
        'p-3',
    );
    document.querySelector('h3').after(report);
}

function removeMessage() {
    const oldMessage = document.querySelector('.alert-danger');
    if (oldMessage) {
        oldMessage.remove();
    }
}

function messageWarning(message) {

    const div = document.createElement('div');
    div.classList.add(
        'alert',
        'alert-danger',
    );
    div.textContent = message;

    document.querySelector('h3').after(div);
}
