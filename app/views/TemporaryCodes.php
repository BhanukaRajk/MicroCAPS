
.custom-select,
.custom-select-2 {
position: relative;
display: inline-block;
font-size: 14px;
}

.custom-select .selector-options,
.custom-select-2 .selector-options {
list-style: none;
color: #017EFA;
border: 1px solid;
height: auto;
width: 100%;
position: absolute;
z-index: 1;
background-color: #fff;
padding: 0;
}

.custom-select .selector-options li,
.custom-select-2 .selector-options li {
padding: 0.5rem;
display: flex;
align-items: center;
justify-content: center;
cursor: pointer;
transition: background 0.3s ease;
}

.custom-select .selector-options li:hover,
.custom-select-2 .selector-options li:hover {
background: #017EFA;
color: white
}