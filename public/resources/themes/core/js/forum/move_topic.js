export function move_topic() {
    document.body.addEventListener("click", e => {
        if(e.target.closest(".open_move_topic_modal")) {
            e.preventDefault();

            const curTrgt = document.querySelector(".open_move_topic_modal");
            const uid = curTrgt.dataset.id;

            document.querySelector("#move_topic_modal #dynamic-content").innerHTML = '';
            document.querySelector("#move_topic_modal #modal-loader").style.display = "block";

            fetch('/resources/jquery/addons/ajax/blade/init.forum_move_topic.php', {
                method: 'post',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({
                    id: uid
                })
            })
            .then(r => r.text())
            .then(data => {
                document.querySelector("#move_topic_modal #dynamic-content").innerHTML = '';
                document.querySelector("#move_topic_modal #dynamic-content").innerHTML = data;
                document.querySelector("#move_topic_modal #modal-loader").style.display = "none";
            })
            .catch(err => {
                document.querySelector("#move_topic_modal #dynamic-content").innerHTML =
                    '<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...';
                document.querySelector("#move_topic_modal #modal-loader").style.display = "none";
            })
        }
    });
}
export function move_topic_submit() {
    document.body.addEventListener("click", e => {
        if(e.target.closest("#move_topic_submit")) {
            const topicID   =   document.querySelector('input[name="TopicID"]');
            const topicIDValue  =   topicID.value;
            const topicTitle   =   document.querySelector('input[name="TopicTitle"]');
            const topicTitleValue   =   topicTitle.value;
            const destination = document.querySelector('select[name="Destination"]');
            const destinationValue  =   destination.options[destination.selectedIndex].value;
            fetch('/resources/jquery/addons/ajax/site/forum/topic/move_topic_submit.php', {
                method: 'post',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({
                    topicID: topicIDValue,
                    topicTitle: topicTitleValue,
                    destination: destinationValue
                })
            })
            .then(r => r.text())
            .then(data => {
                document.querySelector("#move_topic_modal #dynamic-content").innerHTML = '';
                document.querySelector("#move_topic_modal #dynamic-content").innerHTML = data;
                document.querySelector("#move_topic_modal #modal-loader").style.display = "none";
            })
            .catch(err => {
                document.querySelector("#move_topic_modal #dynamic-content").innerHTML =
                    '<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...';
                document.querySelector("#move_topic_modal #modal-loader").style.display = "none";
            })
        }
    });
}