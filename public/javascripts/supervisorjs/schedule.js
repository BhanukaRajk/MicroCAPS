// TASK COMPLETION UPDATING FUNCTION
const taskStateCheckboxes = document.querySelectorAll("input[type=checkbox][class=P28_taskrecord]");

for (let task of taskStateCheckboxes) {

    task.addEventListener('change', function() {

        const selectedTask = this.id;
        let selectedTaskStatus;

        if(this.checked) {
            selectedTaskStatus = 1;
        } else {
            selectedTaskStatus = 0;
        }

        const TaskData = selectedTask.split("-");
        console.log(TaskData[0]);


        const formData = new FormData();
        formData.append("car_id", TaskData[0]);
        formData.append("process_id", TaskData[1]);
        formData.append("status", selectedTaskStatus);

        if (!formData) {
            console.error("FormData not supported");
            return;
        }
        

        fetch("http://localhost:8080/MicroCAPS/Supervisors/recordScheduleStatus", {
            method: "POST",
            // headers: {
            //     'Content-type': 'multipart/form-data'
            //     // 'Content-type': 'application/json'
            // },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch((error) => { 
                const taskRecord = document.querySelector('#'+selectedTask);
                console.log(taskRecord);

                if(taskRecord.checked == true) {
                    taskRecord.checked = false;
                } else {
                    taskRecord.checked = true;
                }

                // notifyMe();

                console.error(error);
            });
    })
};






const processstateboxes = document.querySelectorAll("input[type=checkbox][name=schedule-task-status]");

for (let task of taskstaeboxes) {

    task.addEventListener('change', function() {

        const selectedTask = this.id;
        let selectedTaskStatus;

        if(this.checked) {
            selectedTaskStatus = 1;
        } else {
            selectedTaskStatus = 0;
        }

        const TaskData = selectedTask.split("-");
        console.log(TaskData[0]);


        const formData = new FormData();
        formData.append("car_id", TaskData[0]);
        formData.append("process_id", TaskData[1]);
        formData.append("status", selectedTaskStatus);

        if (!formData) {
            console.error("FormData not supported");
            return;
        }
        

        fetch("http://localhost:8080/MicroCAPS/Supervisors/recordScheduleStatus", {
            method: "POST",
            // headers: {
            //     'Content-type': 'multipart/form-data'
            //     // 'Content-type': 'application/json'
            // },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch((error) => { 
                const taskRecord = document.querySelector('#'+selectedTask);
                console.log(taskRecord);

                if(taskRecord.checked == true) {
                    taskRecord.checked = false;
                } else {
                    taskRecord.checked = true;
                }

                // notifyMe();

                console.error(error);
            });
    })
};