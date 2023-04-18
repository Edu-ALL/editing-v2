<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    async function postJSON(data) {
        try {
            const response = await fetch("{{ route('delete-token') }}", {
                method: "POST", // or 'PUT'
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();
            console.log("Success:", result);
        } catch (error) {
            console.error("Error:", error);
        }
    }

    const actionBtn = document.getElementById('action-btn');
    actionBtn.addEventListener('click', () => {
        window.location.replace("http://www.w3schools.com");
    })
</script>
