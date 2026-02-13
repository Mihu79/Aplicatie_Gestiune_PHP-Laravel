<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Etichetă {{ $device->inventory_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
           
            --label-width: 90mm;
            --label-height: 28mm; 
        }

        body {
            
            font-family: 'Lato', sans-serif;
            background-color: #e5e7eb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .label-container {
            width: var(--label-width);
            height: var(--label-height);
            background: white;
            border: 1px dashed #666;
            padding: 1mm;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
        }

        @media print {
            @page { size: var(--label-width) var(--label-height); margin: 0; }
            body { background: white; display: block; height: auto; margin: 0; }
            .label-container { width: 100%; height: 100%; border: none; position: absolute; top: 0; left: 0; }
        }

        .qr-code-box {
            flex-shrink: 0;
            width: 25mm;
            height: 25mm; 
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .text-content {
            flex-grow: 1;
            text-align: center;
            padding: 0 1mm;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            min-width: 0; 
        }

        .label-title {
            
            font-size: 8pt; 
            font-weight: 700; 
            color: #444;
            text-transform: none; 
            margin-bottom: 0.5mm;
        }

        .inventory-number {
            font-size: 14pt; 
            font-weight: 900; 
            color: #000;
            line-height: 1;
            white-space: nowrap;
        }

        .brand-model {
            font-size: 7pt;
            font-weight: 700;
            color: #000;
            margin-bottom: 1mm; 
            white-space: nowrap; 
            overflow: hidden; 
            text-overflow: ellipsis;
        }

        .icon-box {
            flex-shrink: 0;
            width: 16mm;
            height: 25mm;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 1mm;
            border-left: 1px solid #eee; 
        }
    </style>
</head>
<body>

    <div class="label-container">
        <div class="qr-code-box">
            {!! QrCode::size(90)->margin(0)->generate(url('/admin/devices/'.$device->id)) !!}
        </div>

        <div class="text-content">
            <div class="brand-model">
                {{ Str::limit($device->brand . ' ' . $device->model, 20) }}
            </div>
            
            <div class="label-title">
                Indicativ:
            </div>
            
            <div class="inventory-number">
                {{ $device->inventory_number }}
            </div>
        </div>

        <div class="icon-box">
            <svg style="width: 14mm; height: 14mm; color: #000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
            </svg>
        </div>
    </div>

</body>
</html>