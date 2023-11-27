<x-admin-master>
    @section('content')
        <h1 class="h3 mb-4 text-gray-800"></h1>

        <section id="content" class="dash-content">
            <div class="text-center">
                <h1 class="none">SLTA's Dashboard </h1>
            </div>
            <main>
                <div class="head-title">
                    <!-- Add any titles or headings here -->
                </div>

                <ul class="box-info">
                    <li id="dash-hover">
                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <h3>10</h3>
                            <p>Reports</p>
                        </span>
                    </li>
                    <li id="dash-hover">
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <h3>50</h3>
                            <p>Visitors</p>
                        </span>
                    </li>
                    <li id="dash-hover">
                        <i class='bx bxs-dollar-circle'></i>
                        <span class="text">
                            <h3>$5,000</h3>
                            <p>Total Collected</p>
                        </span>
                    </li>
                </ul>

                <div class="table-data">
                    <div class="order" id="dash-hover">
                        <div class="head">
                            <h3>Monthly Collection</h3>
                            <span>2022</span>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="background-color: #45a9de; color: #fff;">Month</th>
                                    <th style="background-color: #45a9de; color: #fff;">Status</th>
                                    <th style="background-color: #45a9de; color: #fff;">Month</th>
                                    <th style="background-color: #45a9de; color: #fff;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p>January</p>
                                    </td>
                                    <td>
                                        <span class="status waiting">Waiting</span>
                                    </td>
                                    <td>
                                        <p>February</p>
                                    </td>
                                    <td>
                                        <span class="status pending">Pending</span>
                                    </td>
                                </tr>
                                <!-- Repeat the rows for each month -->
                            </tbody>
                        </table>
                    </div>
                    <div class="order" id="dash-hover">
                        <div class="head">
                            <h3>Payments</h3>
                            <span><a href="#">History</a></span>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="background-color: #45a9de; color: #fff;"> Recepit Number</th>
                                    <th style="background-color: #45a9de; color: #fff;">Description</th>
                                    <th style="background-color: #45a9de; color: #fff;">Amount</th>
                                    <th style="background-color: #45a9de; color: #fff;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-row">
                                    <td>
                                        <a href="#">
                                            <strong>Receipt #001</strong>
                                        </a>
                                    </td>
                                    <td>Payment for services</td>
                                    <td class="mr4 ml4">
                                        $100 XCD
                                    </td>
                                    <td>
                                        April 1, 2022
                                    </td>
                                </tr>
                                <!-- Repeat the rows for each payment -->
                            </tbody>
                        </table>
                    </div>
                    <div class="todo" id="dash-hover">
                        <div class="head">
                            <h3>News Feed</h3>
                        </div>
                    </div>
                </div>
            </main>
        </section>
    @endsection
</x-admin-master>
