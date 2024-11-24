// Define responses for each question
const responses = {
  "What are the steps to apply for a Barangay Business Permit?":
    "To apply for a Barangay Business Permit, you need to:<br>1. Fill out an application form at the Barangay Hall.<br>2. Submit required documents.<br>3. Pay the necessary fees.<br>4. Wait for processing.",
  "Can I renew my Barangay Business Permit online?":
    "Currently, renewals must be done in person at the Barangay Hall.",
  "What should I do if my Barangay Clearance, Business Permit, and Certificate of Indigency has expired?":
    "Visit the Barangay Hall to renew your expired documents. Fines may apply.",
  "What documents do I need for a Certificate of Indigency?":
    "Required documents include a valid ID, proof of residence, and a community tax certificate.",
  "How long is a Certificate of Indigency valid?":
    "The Certificate of Indigency is typically valid for 6 months to 1 year.",
  "Do I need to renew my Barangay Clearance every year?":
    "Yes, a Barangay Clearance is typically valid for one year and needs to be renewed annually for official purposes such as employment or business.",
  "What happens if I lose my Barangay Clearance, Business Permit, and Certificate of Indigency?":
    "If you lose your Barangay Clearance, Business Permit, or Certificate of Indigency, you need to visit the Barangay Hall to request a reissuance.",
  "Is there a fee for the reissuance of a lost Barangay Clearance, Business Permit, and Certificate of Indigency?":
    "Yes, there is usually a small fee for reissuing a lost Barangay Clearance, Business Permit, or Certificate of Indigency.",
  "What is the difference between a Barangay Business Permit and a Barangay Clearance?":
    "A Barangay Business Permit is required to operate a business within the barangay, while a Barangay Clearance is a document certifying that you have no pending cases or issues in the barangay.",
  "Gaano katagal valid ang Certificate of Indigency?":
    "Karaniwang valid ito mula 6 na buwan hanggang 1 taon.",
  "Kailangan ko bang i-renew ang Barangay Clearance bawat taon?":
    "Oo, ito ay valid sa loob ng isang taon at kailangang i-renew taun-taon.",
  "Ano ang mga hakbang sa pag-apply ng Barangay Business Permit?":
    "1. Punan ang form sa Barangay Hall.<br>2. Ibigay ang mga kinakailangang dokumento.<br>3. Magbayad ng bayarin.<br>4. Maghintay para sa pagproseso.",
  "Puwede ko bang i-renew ang Barangay Business Permit online?":
    "Sa kasalukuyan, ang pag-renew ng Barangay Business Permit ay kailangang gawin nang personal sa Barangay Hall.",
  "Ano ang dapat gawin kung nag-expire ang aking Barangay Clearance, Business Permit, at Certificate of Indigency?":
    "Kung ang iyong mga dokumento ay nag-expire na, pumunta sa Barangay Hall para sa renewal.",
  "Ano ang mga dokumento na kailangan para sa Certificate of Indigency?":
    "Kailangan ang mga sumusunod na dokumento: isang valid ID, patunay ng paninirahan, at community tax certificate.",
  "Ano ang pagkakaiba ng Barangay Business Permit at Barangay Clearance?":
    "Ang Barangay Business Permit ay kinakailangan para magpatakbo ng negosyo sa barangay, samantalang ang Barangay Clearance ay nagpapatunay na wala kang kaso o pending na isyu sa barangay.",
  "May bayad ba ang reissuance ng nawalang Barangay Clearance, Business Permit, at Certificate of Indigency?":
    "Oo, karaniwang may bayad para sa reissuance ng nawalang Barangay Clearance, Business Permit, at Certificate of Indigency.",
};

function toggleChat() {
  const chatbox = document.getElementById("chatbox");
  chatbox.style.display = chatbox.style.display === "block" ? "none" : "block";
}

function selectLanguage(language) {
  const englishQuestions = document.getElementById("english-questions");
  const tagalogQuestions = document.getElementById("tagalog-questions");
  englishQuestions.style.display = "none";
  tagalogQuestions.style.display = "none";

  if (language === "english") {
    englishQuestions.style.display = "block";
  } else if (language === "tagalog") {
    tagalogQuestions.style.display = "block";
  }
  setTimeout(scrollToBottom, 50); // Ensure scroll after showing language questions
}

function sendMessage(message) {
  const chatboxContent = document.getElementById("chatbox-content");

  // Append user's message
  const userMessage = document.createElement("p");
  userMessage.className = "user-message";
  userMessage.innerHTML = message;
  chatboxContent.appendChild(userMessage);

  // Scroll to bottom immediately after user's message
  scrollToBottom();

  // Add bot response after a delay
  setTimeout(() => {
    const botResponse = document.createElement("p");
    botResponse.className = "message";
    botResponse.innerHTML =
      responses[message] ||
      "Sorry, I don't have an answer for that. Please refer to the FAQs or contact us for assistance.";
    chatboxContent.appendChild(botResponse);

    // Scroll to bottom again after bot's response
    scrollToBottom();
  }, 500);
}
function handleUserInput() {
  const inputField = document.getElementById("userInput");
  const message = inputField.value.trim();

  if (message !== "") {
    sendMessage(message);
    inputField.value = "";
  }
}

function scrollToBottom() {
  const chatboxContent = document.getElementById("chatbox-content");
  chatboxContent.scrollTo({
    top: chatboxContent.scrollHeight,
    behavior: "smooth",
  });
}
