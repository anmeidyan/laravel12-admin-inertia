import AdminLayout from '@/Layouts/AdminApp'
import { Head, Link } from '@inertiajs/react'
import Alert from '@/Components/Alert'

export default function Dashboard() {
    return (
        <AdminLayout>
            <Head title="Dashboard" />
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                        <div className="col-sm-6">
                            <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item active"><Link href="/admin-panel/dashboard">Home</Link></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section className="content">
                <div className="container-fluid">
                    <Alert />
                    <div className="row">
                        <div className="col-lg-3 col-6">
                            <div className="small-box bg-info">
                                <div className="inner">
                                    <h3>150</h3>

                                    <p>New Orders</p>
                                </div>
                                <div className="icon">
                                    <i className="ion ion-bag"></i>
                                </div>
                                <Link href="javascript:void(0)" className="small-box-footer">More info <i className="fas fa-arrow-circle-right"></i></Link>
                            </div>
                        </div>
                        <div className="col-lg-3 col-6">
                            <div className="small-box bg-success">
                                <div className="inner">
                                    <h3>53<sup style={{ fontSize: '20px' }}>%</sup></h3>

                                    <p>Bounce Rate</p>
                                </div>
                                <div className="icon">
                                    <i className="ion ion-stats-bars"></i>
                                </div>
                                <Link href="javascript:void(0)" className="small-box-footer">More info <i className="fas fa-arrow-circle-right"></i></Link>
                            </div>
                        </div>
                        <div className="col-lg-3 col-6">
                            <div className="small-box bg-warning">
                                <div className="inner">
                                    <h3>44</h3>

                                    <p>User Registrations</p>
                                </div>
                                <div className="icon">
                                    <i className="ion ion-person-add"></i>
                                </div>
                                <Link href="javascript:void(0)" className="small-box-footer">More info <i className="fas fa-arrow-circle-right"></i></Link>
                            </div>
                        </div>
                        <div className="col-lg-3 col-6">
                            <div className="small-box bg-danger">
                                <div className="inner">
                                    <h3>65</h3>

                                    <p>Unique Visitors</p>
                                </div>
                                <div className="icon">
                                    <i className="ion ion-pie-graph"></i>
                                </div>
                                <Link href="javascript:void(0)" className="small-box-footer">More info <i className="fas fa-arrow-circle-right"></i></Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </AdminLayout>
    )
}