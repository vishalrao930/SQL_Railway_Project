let remBt=document.querySelector("#removePass");
let addBt=document.querySelector("#addPass");
let fieldSet=document.querySelector(".fieldset");

remBt.addEventListener('click',()=>{
    let numPass=Number(document.querySelector('#count').getAttribute('value'));
    if(numPass>1){
        fieldSet.removeChild(fieldSet.children[fieldSet.children.length-1]);
        document.querySelector('#count').setAttribute('value',numPass-1);
    }
});

addBt.addEventListener('click',()=>{
    let numPass=Number(document.querySelector('#count').getAttribute('value'));
    field=document.createElement('div');
    field.setAttribute('class',fieldSet.children[0].getAttribute('class'));
    field.innerHTML=fieldSet.children[0].innerHTML;
    fieldSet.appendChild(field); 
    field=Array.from(fieldSet.children)[fieldSet.children.length-1];
    inps=field.querySelectorAll('input');
    for(let i=0;i<inps.length;i++){
        nn=inps[i].getAttribute('name').split("'")[1];
        inps[i].setAttribute('name',`passengers[${numPass}]['${nn}']`);
    } 
    field.querySelector('select').setAttribute('name',`passengers[${numPass}]['gender']`);
    document.querySelector('#count').setAttribute('value',numPass+1);
});