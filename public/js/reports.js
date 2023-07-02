let months = null;
let salesData=null;
let purchasesData =null;
let messages = null;

function chartAmountInMonth(labels, amounts, year) {
    const salesCanvas = document.getElementById('amountMonthly');

    if (salesCanvas != null) {
        new Chart(salesCanvas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: messages["chart_sales"],
                    data: amounts.salesValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                },
                    {
                        label: messages["chart_purchases"],
                        data: amounts.purchaserValue,
                        backgroundColor: 'rgba(34, 40, 49, 0.7)'
                    }]
            },
            options: {
                responsive: true,
                fill: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: messages["chart_amount"]
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: messages["chart_months"]
                        }
                    }
                },
                plugins: {
                    titleY: messages["chart_price"],
                    title: {
                        display: true,
                        text: messages["chart_number_amount_invoice_month"] + ' ' + year,
                        font: {
                            size: 14,
                        },
                    }
                },
            },

        });
    }
}
function chartCountInvoiceInMonth(labels, counts, year) {
    const salesCanvas = document.getElementById('countMonthly');
    if (salesCanvas != null) {
        new Chart(salesCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: messages["chart_sales"],
                    data: counts.salesCount,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                },
                    {
                        label: messages["chart_purchases"],
                        data: counts.purchaserCount,
                        backgroundColor: 'rgba(34, 40, 49, 0.7)'
                    }]
            },
            options: {
                responsive: true,
                fill: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                        },
                        title: {
                            display: true,
                            text: messages["chart_count_invoice"]
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: messages["chart_months"]
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: messages["chart_number_invoice_month"] + ' ' + year,
                        font: {
                            size: 14,
                        },
                    }
                },
            },

        });
    }
}

function setPricesMonthly(data) {
    let prices = new Array(months.length).fill(0);

    for (const dataKey in data) {
        let row = data[dataKey];
        prices[row.month-1] = row.amount;
    }
    return prices;
}
function setCountInvoiceMonth(data) {
    let count = new Array(months.length).fill(0);

    for (const dataKey in data) {
        let row = data[dataKey];
        count[row.month-1] = row["invoiceCount"];
    }
    return count;
}

// Start Get Messages
fetch("http://estore.local/reports/getMessagesAjax", {
    "method": "POST",
    "headers": {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    "body": `nameFile=reports.default`,
})
    .then((r)=> r.json())
    .then((data)=> {
        messages = data;
    })
// End Get Messages

// Start Draw Charts For Month
fetch("http://estore.local/reports/getMonthsAjax", {
    "method": "POST",
    "headers": {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    "body": ``,
})

    .then(function(res){ return res.json(); })
    .then(function(data){
        months = Object.values(data);
        fetch("http://estore.local/reports/getMonthlySalesAjax", {
            "method": "POST",
            "headers": {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            "body": ``,
        })
            .then(function(res){ return res.json(); })
            .then(function(data){
                let sales = setPricesMonthly(data);
                let salesCount = setCountInvoiceMonth(data);
                salesData = {
                    labels: months,
                    values: sales,
                    salesCount: salesCount
                };
            })
            .then(() => {
                fetch("http://estore.local/reports/getMonthlyPurchasesAjax", {
                    "method": "POST",
                    "headers": {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    "body": ``,
                })
                    .then(function(res){ return res.json(); })
                    .then(function(data){
                        let year = data[0].year;
                        let purchases = setPricesMonthly(data);
                        let purchaseCount = setCountInvoiceMonth(data);
                       purchasesData = {
                            labels: months,
                            values: purchases,
                           purchaseCount:purchaseCount
                        };
                        chartAmountInMonth(purchasesData.labels,
                            {"purchaserValue":purchasesData.values, "salesValues": salesData.values}, year);
                        chartCountInvoiceInMonth(months,
                            {"purchaserCount":purchasesData.purchaseCount, "salesCount": salesData.salesCount}, year);

                    })
            })
    });
// End Draw Charts For Month


// Start Draw Chart For Year
let salesYearly = null;
let purchasesYearly = null;
function prepareYears(stop=10) {

    const currentYear = new Date().getFullYear();
    const lastYears = [];
    for (let i = 0; i < stop; i++) {
        lastYears.push(currentYear - i);
    }

    return lastYears
}
function setPriceYearly(data, years) {
    let price = [];

    for (const dataKey in data) {
        let row = data[dataKey];
        price.push(row.amount);
    }

    if (price.length < years.length) {
        while (years.length - price.length !== 0) {
            price.push(0);
        }
    }
    return price.reverse();
}
function prepareCountYearly(data) {
    let years = prepareYears();
    let counts = []
    for (const dataKey in data) {
        counts.push(data[dataKey]["invoiceCount"])
    }
    if (counts.length < years.length) {
        for (let i = years.length - counts.length; i !== 0; i--) {
            counts.push(0);
        }
    }

    return counts.reverse();
}
function chartAmountYearly(labels, data) {
    const salesCanvas = document.getElementById('amountYearly');
    if (salesCanvas != null) {
        new Chart(salesCanvas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: messages["chart_sales"],
                    data: data.sales.values,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                },{
                    label: messages["chart_purchases"],
                    data: data.purchases.values,
                    backgroundColor: 'rgba(34, 40, 49, 0.7)'
                }]
            },
            options: {
                responsive: true,
                fill: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: messages["chart_amount"]
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: messages["chart_yearly"]
                        }
                    }
                },
                plugins: {
                    titleY: messages["chart_price"],
                    title: {
                        display: true,
                        text: messages["chart_number_amount_invoice_yearly"],
                        font: {
                            size: 14,
                        },
                    }
                },
            },
        });
    }

}
function chartCountInvoiceInYearly(labels, data) {
    const salesCanvas = document.getElementById('countYearly');
    if (salesCanvas != null) {
        new Chart(salesCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: messages["chart_sales"],
                    data: data.sales.counts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                },{
                    label: messages["chart_purchases"],
                    data: data.purchases.counts,
                    backgroundColor: 'rgba(34, 40, 49, 0.7)'
                },]
            },
            options: {
                responsive: true,
                fill: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                        },
                        title: {
                            display: true,
                            text: messages["chart_count_invoice"]
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: messages["chart_yearly"]
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: messages["chart_number_invoice_yearly"],
                        font: {
                            size: 14,
                        },
                    }
                },
            },

        });
    }

}
fetch("http://estore.local/reports/getYearlySalesAjax", {
    "method": "POST",
    "headers": {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    "body": ``,
})

    .then(function(res){ return res.json(); })
    .then(function(data){

        let years = prepareYears().reverse();
        let valuesSales = setPriceYearly(data, years.reverse());

        let counts = prepareCountYearly(data)

        salesYearly = {
            values: valuesSales,
            labels: years.reverse(),
            counts: counts
        }

    })
    .then(() => {
        fetch("http://estore.local/reports/getYearlyPurchasesAjax", {
            "method": "POST",
            "headers": {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            "body": ``,
        })
            .then(function(res){ return res.json(); })
            .then((data) => {
                let counts = prepareCountYearly(data)
                purchasesYearly = {
                    values: setPriceYearly(data, prepareYears().reverse()),
                    counts: counts
                };
                chartAmountYearly(salesYearly.labels, {sales: salesYearly, purchases: purchasesYearly});
                chartCountInvoiceInYearly(salesYearly.labels, {sales: salesYearly, purchases: purchasesYearly});
            });
    })
// End Draw Chart For Year


