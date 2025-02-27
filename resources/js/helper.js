const notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top'
    },
    types: [
        {
            type: 'error',
            background: 'indianred',
            duration: 5000,
            dismissible: true
        },
        {
            type: 'success',
            background: '#6c4abf',
            duration: 5000,
            dismissible: true
        }
    ]
});


export function alert(status, message) {

    if(status == 'success') {
        notyf.success(message);
    }

    if(status == 'error') {
        notyf.error(message);
    }

}

export function remove(table, url, token) {
    Swal.fire({
        icon: "info",
        title: "Are your sure to delete?",
        text: `Please be informed that this action cannot be undone or reverted`,
        showCancelButton: true,
        confirmButtonText: "Yes, I Know",
        denyButtonText: `Don't save`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: token,
                },
                success: function (result) {
                    alert(result.status, result.message);
                    table.ajax.reload();
                },
                error: function (xhr) {
                    alert(
                        "An error occurred while trying to delete the property type."
                    );
                },
            });
        }
    });
}

export function canvasDownload(elem, filename) {
    const { jsPDF } = window.jspdf;

    html2canvas($(elem)[0]).then(canvas => {
        let imgData = canvas.toDataURL("image/png");
        let imgWidth = 57; // Fixed width in mm
        let imgHeight = (canvas.height * imgWidth) / canvas.width; // Adjust height dynamically

        let doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: [imgWidth, imgHeight] // Width fixed, height dynamic
        });

        // Calculate center position
        let pageWidth = doc.internal.pageSize.getWidth();
        let pageHeight = doc.internal.pageSize.getHeight();
        let xPos = (pageWidth - imgWidth) / 2; // Center horizontally
        let yPos = (pageHeight - imgHeight) / 2; // Center vertically

        doc.addImage(imgData, 'PNG', xPos, yPos, imgWidth, imgHeight);
        doc.save(filename + ".pdf");
    });
}
