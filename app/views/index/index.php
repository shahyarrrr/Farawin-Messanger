<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/home.css">
    
<title>chat</title>
</head>
<body>
    <main class="main">            
        
        <div class="contact-list-container">
            <div class="contact-list-header">
                <button class="contact-add" onclick="openModal()">+</button>
                <button class="contact-add" onclick="refreshContactList()">
                    <img src="public/images/refresh_icon.png" alt="" class="refresh-img">
                </button>
                <span id="thisistest"></span>
            </div>
            <div class="contact-list" id="contactList">
                
            </div>
        </div>
        <div class="chat-container" id="chatContainer">
            <div class="navbar">
                <button class="contact-add" id='refreshChat' onclick="refreshChat()">
                    <img src="public/images/refresh_icon.png" alt="" class="refresh-img">
                </button>
                <p class="chat-name" id="chatName"></p>
                <img src="" alt="" class="chat-profile" id="profile">
            </div>
            <div class="chat-list" id="chatList">

            </div>
            <form onsubmit="sendMessage(event); return false">
                <div class="chat-input">
                    <button class="chat-send" type="submit">
                        <img src="public/images/send.png" alt="" class="send-image">
                    </button>
                    <input type="text" class="chat-input-field" id="chatInput">
                </div>
            </form>
        </div>


        <div id="editModal" class="modal">
            <div class="editmodal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                    <form id="editcontact-form">
                        <h2>Edit Contact</h2>

                        <input id="contact-id" type="hidden">
                        <label for="name">new name:</label>
                        <input type="text" name="new-name" id="new-name">

                        <button class="edit-button" type="submit">Edit</button>
                        <br>
                        <span id="errorField"></span>
                    </form>
            </div>
        </div>

        <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
                <form id="addcontact-form">
                    <h2>Add Contact</h2>
                    <label for="phone">Phone number:</label>
                    <input type="text" name="phone" id="phone">

                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name">

                    <button class="primary-btn" type="submit">Add</button>
                    <br>    
                    <span id="showError"></span>
                </form>
            </div>
        </div>

    </main>
    <script src="public/js/jquery-3.4.1.min.js"></script>
    <script>
            window.onload = refreshContactList();
            var myData = null;
            var modal = document.getElementById("myModal");
           
            function openModal() {
                modal.style.display = "flex";
            }
            function closeModal() {
                modal.style.display = "none";
            }

            var editmodal = document.getElementById("editModal");

            function openEditModal(id) {
                editmodal.style.display = "flex";
                $("#contact-id").val(id);
            }
            function closeEditModal() {
                editmodal.style.display = "none";
            }


            function refreshContactList() {
                var user_id = <?= Model::session_get('id'); ?>;
                var data
                $.ajax({
                    type: "GET",
                    url: "<?= URL; ?>index/getcontact",
                    data: {
                    },
                    success:async function(response) {
                        wrapContactList(JSON.parse(response).data)
                    },
                    error:function(response) {
                        alert("alert");
                    }
                })
                myData = data
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                } else if (event.target == editmodal) {
                    editmodal.style.display = "none";
                }
            }

            $(document).ready(function() {
                $("#editcontact-form").on('submit', function(e) {
                    e.preventDefault();
                    var new_name = $("#new-name").val();
                    var contact_id = $("#contact-id").val();

                    $.ajax({
                        type: "POST",
                        url: "<?= URL; ?>index/editcontact",
                        data: {
                            "new-name":new_name,
                            "contact-id":contact_id
                        },
                        success:function(response) {
                            response = JSON.parse(response);
                            if (response.status == true) {
                                refreshContactList();
                                $("#errorField").text(response.message);
                            } else {
                                $("#errorField").text(response.message);
                            }
                        },
                        error: function() {
                            alert("alert!");
                        }
                    });
                });
            });

            $(document).ready(function() {
            $('#addcontact-form').on('submit', function(e) {
                e.preventDefault(); 
                var phone = $("#phone").val();
                var name = $("#name").val();

                $.ajax({
                    type: 'POST',
                    url: "<?= URL; ?>index/addcontact",
                    data: {
                        phone:phone,
                        name:name
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status == true) {
                            $("#showError").text(response.message);
                            refreshContactList()
                        } else {
                            $("#showError").text(response.message);
                        }
                    },
                    error: function() {
                        alert("alert!");
                    }
                });
            });
        });
            
        function craeteContact(src, name, text, id) {
            
            const linkTag = document.createElement('div');
            linkTag.setAttribute("contact-id", id);

            const contactBoxTag = document.createElement('div');
            contactBoxTag.classList.add('contact-box');
            contactBoxTag.addEventListener('click', ()=>{
                localStorage.setItem('contact_id', id)
                localStorage.setItem('srcprof', src)
                $('.contact-box').removeClass('active')
                contactBoxTag.classList.add('active')
                $.ajax({
                    type: "GET",
                    url: "<?= URL; ?>index/chatContainer",
                    data: {
                        contact_id : localStorage.getItem('contact_id')                    },
                    success: function(response) {
                        response = JSON.parse(response)
                        if (response.status == true) {
                            $("#chatName").text(response.name)
                            $("#profile").attr("src", localStorage.getItem('srcprof'))
                            refreshChat()
                        }
                    },
                    error: function(response) {
                        alert('alert')
                    }
                })
                $('#chatContainer').css('opacity', '1')
            })

            const imageTag = document.createElement('img')
            imageTag.src = src;
            imageTag.classList.add('contact-profile');

            const contentTag = document.createElement('div');
            contentTag.classList.add('contact-content');

            const nameTag = document.createElement('p');
            nameTag.textContent = `${name}`;
            nameTag.classList.add('name');

            const textTag = document.createElement('p');
            textTag.textContent = text;
            textTag.classList.add('summery');

            const editIcon = document.createElement('img');
            editIcon.src = 'public/images/edit.png';
            editIcon.alt = 'edit';
            editIcon.classList.add('edit-icon');

            const editButton = document.createElement('button');
            editButton.src = 'public/images/edit.png';
            editButton.onclick = function(e) {
                openEditModal(id);
            };
            editButton.appendChild(editIcon);

            
            contentTag.appendChild(nameTag);
            contentTag.appendChild(textTag);

            contactBoxTag.appendChild(imageTag);
            contactBoxTag.appendChild(contentTag);
            contactBoxTag.appendChild(editButton);

            linkTag.appendChild(contactBoxTag);

            return linkTag
        }
        function wrapContactList(list) {
            $("#contactList div").remove()
            list.map((item, index)=> {
            document.querySelector('#contactList').appendChild(
                craeteContact(item.src, item.name, item.text, item.id)
            )
        })
        }

        // send message

        function sendMessage(event) {
            var inputValue = $('#chatInput').val()
            $('#chatInput').val('')
            var contact_id = localStorage.getItem('contact_id')
            $.ajax({
                type: "POST",
                url: "<?= URL; ?>index/sendMessage",
                data :{
                    message : inputValue,
                    contact_id :contact_id,
                },
                success : function(response) {
                    response = JSON.parse(response)
                    if (response.status == true) {
                        console.log(response);
                        refreshChat()
                    }
                    
                }
            })
        }

        function refreshChat() {
            $.ajax({
                type: "GET",
                url: "<?= URL; ?>index/refreshChat",
                data: {
                    recv_id : localStorage.getItem("contact_id"),
                },
                success: function(response) {
                    response = JSON.parse(response)
                    if (response.status == true) {
                        wrapchatList(response.messages)
                    }
                }
            })
        }

        function appendMessage(content, sender, date) {
            // Create a new div element for the message
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message');

            // Set the class based on the sender
            if (sender === true) {
                messageDiv.classList.add('sent');
                const editButton = document.createElement('button');
                editButton.innerText = 'Edit';
                editButton.classList.add('edit-button');

                const deleteButton = document.createElement('button');
                deleteButton.innerText = 'Delete';
                deleteButton.classList.add('delete-button');

                editButton.addEventListener('click', () => editMessage(messageDiv, messageContent, dateSpan));
                deleteButton.addEventListener('click', () => deleteMessage(messageContent, dateSpan));

                messageDiv.appendChild(editButton);
                messageDiv.appendChild(deleteButton);
            } else {
                messageDiv.classList.add('received');
            }

            // Create a span element to hold the date
            const dateSpan = document.createElement('span');
            dateSpan.classList.add('date');
            dateSpan.innerText = date;

            // Create a paragraph element to hold the message content
            const messageContent = document.createElement('p');
            messageContent.innerText = content;

            // Append the date span, message content, and buttons to the message div
            messageDiv.appendChild(dateSpan);
            messageDiv.appendChild(messageContent);


            // Get the chat list container
            const chatList = document.querySelector('.chat-list');

            // Append the message div to the chat list
            chatList.appendChild(messageDiv);

            // Scroll to the bottom of the chat list
            chatList.scrollTop = chatList.scrollHeight;
        }

        function editMessage(messageDiv, messageContent, dateSpan) {
            const newContent = prompt('Edit your message:', messageContent.innerText);
            if (newContent !== null) {
                $.ajax({
                    type: "POST",
                    url: "<?= URL; ?>index/editMessage",
                    data: {
                        new_message : newContent,
                        old_message : messageContent.innerText,
                        date:dateSpan.innerText,
                        contact_id : localStorage.getItem('contact_id')
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status == true) {
                            refreshChat();
                        } else {
                            alert('alert');
                        }
                    },
                    error: function(response) {
                        alert('alert');
                    }
                })
            }
        }

        function deleteMessage(messageContent, dateSpan) {
            const isConfirmed = confirm("Are you sure you want to delete this message?");
            if (isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= URL; ?>index/deleteMessage",
                    data: {
                        msg: messageContent.innerText,
                        date: dateSpan.innerText,
                        contact_id: localStorage.getItem('contact_id')
                    },
                    success: function(response) {
                        response = JSON.parse(response)
                        if (response.status == true) {
                            refreshChat();
                        }
                    },
                    error: function(response) {
                        alert('alert')
                    }
                })
            }
        }

        function wrapchatList(list) {
            $("#chatList div").remove()
            list.map((item, index)=> {
                appendMessage(item.text, item.boolean, item.send_date)
        })
        }

        function clickButton() {
            const button = document.getElementById('refreshChat');
            if (button) {
                button.click()
            }
        }

        // setInterval(clickButton, 10000);

    </script>
</body>
</html>