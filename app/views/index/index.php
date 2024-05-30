<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        ::-webkit-scrollbar {
    width: 0px !important;
    background: transparent; /* make scrollbar transparent */
}
        .contact-list {
            display: flex;
            flex-direction: column;
            gap: 2px;
            width: 368px;
            border: 1px solid #ffffffbd;
            padding: 8px;
            height: 87vh;
            margin-top: 5vh;
            margin-right: 2rem;
            border-radius: 32px;
            overflow-y: auto;

        }
        .contact-box {
            border: 1px solid #ffffffbd;
            border-radius: 24px;
            display: flex;
            flex-direction: row-reverse;
            gap: 16px;
            justify-content: flex-start;
            align-items: center;
            padding: 10px 16px;
        }
        .contact-profile {
            border-radius: 50%;
            min-width: 40px;
            min-height: 40px;
            object-fit: cover;
        }
        .contact-content {
            text-align: end;
        }
        .name {
            font-weight: bold;
        }
        .summery {
            font-weight: 300;
            font-size: 0.875rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
    </style>
    <title>chat</title>
</head>
<body>
    <form action="<?= URL; ?>addcontact">
        <input type="submit" value="+" />
    </form>
    <main class="">
        <div class="contact-list" id="contactList"></div>
        <div class=""></div>
    </main>
    <script src="public/js/jquery-3.4.1.min.js"></script>
    <script>
        const _mock = [
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '1'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '2'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '3'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '4'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '5'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '6'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '7'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '8'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '9'
            },
            {
                firstNmae: 'شهیار',
                lastName: 'جلال کمالی',
                src: 'تست',
                text: 'شهیار شهیار شهیار شهیار',
                id: '10'
            },
            
        ]
        function craeteContact(src, firstNmae, lastName, text, link) {
            const linkTag = document.createElement('a');
            linkTag.href = link;
            const contactBoxTag = document.createElement('div');
            contactBoxTag.classList.add('contact-box');
            const imageTag = document.createElement('img')
            imageTag.src = src;
            imageTag.classList.add('contact-profile');
            const contentTag = document.createElement('div');
            contentTag.classList.add('contact-content');
            const nameTag = document.createElement('p');
            nameTag.textContent = `${firstNmae} ${lastName}`;
            nameTag.classList.add('name');
            const textTag = document.createElement('p');
            textTag.textContent = text;
            textTag.classList.add('summery');
            
            contentTag.appendChild(nameTag);
            contentTag.appendChild(textTag)
            contactBoxTag.appendChild(imageTag);
            contactBoxTag.appendChild(contentTag);
            linkTag.appendChild(contactBoxTag);

            return linkTag
        }

        _mock.map((item, index)=> {
            document.querySelector('#contactList').appendChild(
                craeteContact(item.src, item.firstNmae, item.lastName, item.text, item.id)
            )
        })
    </script>
</body>
</html>