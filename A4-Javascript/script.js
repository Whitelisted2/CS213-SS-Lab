function checkAge(){
    let displaytext;
    let age = Number(document.getElementById("age").value);
    document.getElementById("age").value = '';
    if(isNaN(age)){
        document.getElementById("demo").innerHTML="Not A Number";
        return;
    }else if(age < 18){
        alert("Too young to drive!");
        document.getElementById("demo").innerHTML="";
    }else if(age > 100){
        alert("Too old to drive!");
        document.getElementById("demo").innerHTML="";
    }else{
        alert("You are eligible to drive!");
        document.getElementById("demo").innerHTML="";
    }
}

function pal(){
    var str = document.getElementById("word").value;
    var lowStr = str.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '');
    // we make the string lowercase, and remove all non-alphanumeric characters. 
    if(lowStr === ""){
        alert("Please Enter A String");
        return false;
    }else if(lowStr.length === 1){
        alert("Yes. It is a palindrome");
        return true;
    }else{
        var i;
        var status = "yes";
        // a VERY rudimentary algorithm to check for palindrome
        for(i = lowStr.length - 1; i >= 0; i--)
        {
            if(lowStr.charAt(i) != lowStr.charAt(lowStr.length - i - 1))
            {
                status = "no";
                break;
            }
            // while checking, if even one pair of characters deviate, then it comes out with "no" status
        }
        if(status == "yes")
        {
            alert("Yes. It is a Palindrome");
            return true;
        }
        if(status == "no"){
            alert("No. It is not a Palindrome");
            return false;
        }
    }   
}
function gcd(){
    var num1 = document.getElementById("number1").value;
    var num2 = document.getElementById("number2").value;
    if(num1 == "" || num2 == "")
    {
        alert("Please enter 2 numbers.");
        return;
    }
    n1 = Math.abs(num1);
    n2 = Math.abs(num2);
    if(n1 === n2)
    {
        alert("The GCD of " + num1 + " and " + num2 + " is " + Math.abs(num1));
        return;
    }
    while(n2 > 0)
    {
        // while n2>0, we divide the divisor by the previous remainder, and get a new remainder. this process repeats until n2 is zero.
        var temp = n2; 
        n2 = n1 % n2;
        n1 = temp;
    }
    // finally, gcd is the last divisor, n1, when n2 becomes zero
    alert("The GCD of " + num1 + " and " + num2 + " is " + n1);
}

function fib(){
    var fibNum = document.getElementById("fibNum").value;
    var num1 = 0;
    var num2 = 1; // first two elements
    var i, nextNum;
    var fibList = [0, 1]; // array implementation for simplicity
    for(i = 0; i < fibNum-2; i++)
    {
        nextNum = num1 + num2;
        num1 = num2; // after getting sum, we "move" them leftwards 
        num2 = nextNum;
        fibList.push(num2); // append to the array
    }
    if(fibNum == 1)
    {
        alert("0"); // a trivial case that the loop can't directly cover
        return;
    }
    if(fibNum == 0)
    {
        alert("if you didn't want any, don't ask lol"); // just in case
        return;
    }
    alert(fibList);
}

function mostFreq(){
    var inputStr = document.getElementById("str").value;
    if(inputStr == "")
    {
        alert("Enter a string, please.");
        return;
    }
    var str = inputStr.toLowerCase().replace(/[^a-zA-Z0-9]+/g, ''); //remove all non-alphanumeric characters
    if(str == "")
    {
        alert("Enter a string with alphanumeric characters, please.");
        return;
    }
    var strArray = str.split("");// making an array
    strArray.sort();             // sort this array
    var count, maxCount;
    maxCount = 0; // this will store freq of most freq occurring char
    const maxChar = []; // this will store most freq occurring character(s)
    var n = strArray.length;
    var i = 0;
    while(i < n)
    {
        count = 1;
        while (i+1 < n && strArray[i+1] == strArray[i])
        {
            count++;
            i++;
        }
        if(count > maxCount)
        {
            maxCount = count;
            maxChar.splice(0, maxChar.length);
            maxChar.push(strArray[i]);
        }
        else if(count == maxCount)
        {
            maxChar.push(strArray[i]);
        }
        i++;
    }
    if(maxChar.length > 1)
    {
        alert("Most Frequent Characters : " + maxChar + "\nNumber of occurrences (of each) : " + maxCount);
        return;
    }
    else
    {
        alert("Most Frequent Character: " + maxChar + "\nNumber of occurrences: " + maxCount);
    }
}

function display(){
    var name = document.getElementById("name").value;
    var address = document.getElementById("address").value;
    var phNum = document.getElementById("phNum").value;
    var email = document.getElementById("email").value;
    var edQual = document.getElementById("edQual").value;
    var age = document.getElementById("age").value;
    // get all values into variables first
  
    var table='';
    for(var r=0; r<6; r++) // add the rows one by one
    {
        table += '<tr>';
        switch(r){
            case 0:
                table += ("<td width='210px'>" + "User.Name" + "</td>");
                if(name!=""){
                    table += ("<td>" + name + "</td>");
                }
                else
                {
                    table += ("<td>" + "Name not entered" + "</td>");
                }
                break;
            case 1:
                table += "<td>" + "User.Address" + "</td>";
                if(address!="")
                {
                    table += "<td>" + address + "</td>";
                }
                else
                {
                    table += "<td>" + "Address not entered" + "</td>";
                }
                break;
            case 2:
                table += "<td>" + "User.Phone Number" + "</td>";
                if(phNum!=""){
                    table += "<td>" + phNum + "</td>";
                }
                else
                {
                    table += "<td>" + "Phone Number not entered" + "</td>";
                }
                break;
            case 3:
                table += "<td>" + "User.EmailID" + "</td>";
                if(email!="")
                {
                    table += "<td>" + email + "</td>";
                }
                else
                {
                    table += "<td>" + "Email ID not entered" + "</td>";
                }
                break;
            case 4:
                table += "<td>" + "User.Educational Qualifications" + "</td>";
                if(edQual!="")
                {
                    table += "<td>" + edQual + "</td>";
                }
                else
                {
                    table += "<td>" + "Edu Qualifications not entered" + "</td>";
                }
                break;
            case 5:
                table += "<td>" + "User.Age" + "</td>";
                if(age!=""){
                    table += "<td>" + age + "</td>";
                }
                else
                {
                    table += "<td>" + "Age not entered" + "</td>";
                }
                break;
        }
        table+='</tr>'; 
    }
   document.write('<style> table{ font-family: Calibri; }');
   // doucment.write() erases all previous data, including CSS. So to format the output table, we just write that on as well
   document.write('tr:nth-child(odd){ background-color: #a09c9c;}');
   document.write('tr:nth-child(even){ background-color: #d0cccc;}');
   // deduced the colors using an online color picker, and alternated them using the nth-child() selector
   document.write('</style>');
   document.write('<br>'+'<center> <table>' + table + '</table> </center>');
}

function addtolist(){
    var ul = document.getElementById("dynamicList");
    var text = document.getElementById("inputString").value;
    document.getElementById("inputString").value = '';
    document.getElementById("submit").disabled = true;
    if (/^\s+$/.test(text)) // to check if the string is entirely whitespace
    {
        alert("empty string!!!");
        return;
    }
    else
    {
        dynamicList.innerHTML += "<li>" + text + "</li>";
        return true;
    }
}