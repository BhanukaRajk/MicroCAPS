// THE SELECT TAG COLLECTING (SELECT VEHICLE => PARTS VIEW)
const compVehicleSelector = document.querySelector('#P23_vehicle_list');

if(compVehicleSelector != null) {

    compVehicleSelector.addEventListener('change', function() {

        // VALUE OF THIS SELECT TAG'S SELECTED DATA
        const selectedValue = this.value;

        const formData = new FormData();
        formData.append("selectedValue", selectedValue);

        if (!formData) {
            console.error("FormData not supported");
            return;
        }
        

        fetch("http://localhost:8080/MicroCAPS/Supervisors/componentsView", {
            method: "POST",
            // headers: {
            //     'Content-type': 'multipart/form-data'
            //     'Content-type': 'application/json'
            // },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {

                // PAGE'S CHANGING POINTS CATCHER
                const partDataBoard = document.querySelector('#partsTable');
                const partPageID = document.querySelector('#partPageId');

                // PARTS TABLE HEADING WRITER
                let partSet = `<div class="parts-table-row">
                                    <div class="parts-col-01 parts-bold">PART NAME</div>
                                    <div class="parts-col-02 parts-bold">STATUS</div>
                                    <div class="parts-col-03 parts-bold">DAMAGES</div>
                                    <div class="parts-col-04 parts-bold">ISSUED</div>
                                </div>
                                <div class="bottom-border"></div>`;


                // CHECKING IF THERE ARE PARTS AVAILABLE FOR SELECTED VEHICLE
                if(data.componentz) {

                    // DISPLAY ALL THE PARTS AVAILABLE
                    (data.componentz).forEach((component) => {
                        partSet += `<div class="parts-table-row bottom-border">
                                                <div class="parts-col-01">${component.PartName}</div>
                                                <div class="parts-col-02">${component.Status}</div>
                                                <div class="parts-col-03">
                                                    <div class="round">
                                                        <input type="checkbox" id="${component.PartNo}-D" ${component.Status == "DAMAGED" ? "checked" : "" } />
                                                        <label class="display-none" for="${component.PartNo}D"></label>
                                                    </div>
                                                </div>
                                                <div class="parts-col-04">
                                                    <div class="round">
                                                        <input type="checkbox" id="${component.PartNo}-I" ${component.Status == "ISSUED" ? "checked" : "" } />
                                                        <label class="display-none" for="${component.PartNo}I"></label>
                                                    </div>
                                                </div>
                                            </div>`;
                    });

                // IF THERE ARE NO ANY PARTS, DISPLAY THE NOTHING MESSAGE
                } else {
                    partSet += `<div class="horizontal-centralizer">
                                                    <div class="marginy-4">No parts available</div>
                                                    <div class=""></div>
                                                </div>
                                                <div class="bottom-border"></div>`;
                }

                // PARTS TABLE DATA CHANGER
                partDataBoard.innerHTML = partSet;


                // PAGE HEADING CHASSIS NUMBER CHANGER
                if(data.search) {
                    partPageID.innerHTML = `Part details - ${data.search}`;
                }

            })
            .catch((error) => console.error(error));
    });
}