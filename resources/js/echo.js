Echo
    .channel('articleUpdated')
    .listen('ArticleUpdatedBySocketForAdmin', (e) => {
       alert('Изменена статья: ' + e.article.name +
           '\nБыли иизмененыы: ' + e.lastChange.after +
           '\nСсылка на статью: ' + window.location.href + 'articles/' + e.article.slug);
    });

Echo
    .channel('showReport')
    .listen('ReportGenerated', (e) => {
        const container = document.querySelector('.report');
        if (container) {
            const h4 = document.createElement('h4');
            h4.textContent = 'Отчет'
            const ul = document.createElement('ul');
            ul.classList.add('list-group');
            const values = Object.values(e.data);
            values.forEach(value => {
                const li = document.createElement('li');
                li.textContent = value;
                li.classList.add('list-group-item');
                ul.prepend(li);
            });
            container.prepend(h4, ul);
        }
    });

