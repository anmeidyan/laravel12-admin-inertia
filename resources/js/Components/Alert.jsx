import { usePage } from '@inertiajs/react'

export default function Alert() {

    const { flash } = usePage().props

    if (!flash?.message) {
        return null
    }

    const colors = {
        success: 'alert-success',
        info: 'alert-info',
        warning: 'alert-warning',
        danger: 'alert-danger',
    }

    return (
        <div className={`alert ${colors[flash.type] ?? 'alert-info'}`}>
            <h5 style={{ margin: '0', fontSize: '17px' }}>
                <i className="icon fas fa-ban"></i> {flash.message}
            </h5>
        </div>
    )
}