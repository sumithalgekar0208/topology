<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NodeType;
use App\Models\Device;
use App\Models\Edge;

class TopologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('topology.index');
    }

    public function getTopologyData() {
        $devices = Device::all();
        $nodesArray = array(
            0 => array(
                    'id' => -1,
                    'label' => "CCR",
                    'color' => array(
                        'background' => '#73A5DF',
                        'border' => '#73A5DF'
                    ),
                    'physics' => false,
                    'shape' => 'circle',
                    'x' => -550,
                    'y' => 400
                ),
            1 => array(
                'id' => -2,
                'label' => "MAG2",
                'color' => array(
                    'background' => '#D9825C',
                    'border' => '#D9825C'
                ),
                'physics' => false,
                'shape' => 'box',
                'x' => -550,
                'y' => 450
            ),
            2 => array(
                'id' => -3,
                'label' => "PEYTO",
                'color' => array(
                    'background' => '#5CD98A',
                    'border' => '#5CD98A'
                ),
                'physics' => false,
                'shape' => 'ellipse',
                'x' => -550,
                'y' => 500
            ),
        );
        $edgesArray = array();
        foreach ($devices as $device) {
            $data = array();
            $data['id'] = $device->id;
            $data['label'] = $device->name;
            $data['color']['background'] = $device->nodeType->background_color;
            $data['color']['border'] = $device->nodeType->border_color;
            $data['physics'] = false;
            $data['shape'] = $device->nodeType->shape;
            $data['x'] = $device->x_axis;
            $data['y'] = $device->y_axis;

            if ($device->name == "DECODER") {
                $data['fixed']['x'] = true;
                $data['fixed']['y'] = true;
                $data['heightConstraint'] = 50;
            }

            $nodesArray[] = $data;

            $deviceEdges = Edge::where('from', $device->id)->get();

            foreach ($deviceEdges as $deviceEdge) {
                $edgeData = array();
                $edgeData['from'] = $deviceEdge->from;
                $edgeData['to'] = $deviceEdge->to;
                if ($deviceEdge->is_connected && $deviceEdge->utilization >= 90) {
                    $edgeData['color']['color'] = '#FE370F';
                    $edgeData['dashes'] = true;
                    $edgeData['title'] = "Degraded & High Utilized > 90%";
                } else if ($deviceEdge->is_connected && $deviceEdge->utilization >= 70 && $deviceEdge->utilization < 90) {
                    $edgeData['dashes'] = true;
                    $edgeData['color']['color'] = "#F39A15";
                    $edgeData['title'] = "High Utilized > 70%";
                } else if ($deviceEdge->is_connected &&  $deviceEdge->utilization < 70 ) {
                    $edgeData['dashes'] = true;
                    $edgeData['color']['color'] = $deviceEdge->color;
                } else {
                    $edgeData['color']['color'] = "#F60D34";
                    $edgeData['title'] = "Complete down";
                }
                $edgeData['smooth']['enable'] = true;
                $edgeData['width'] = 3;
                $edgeData['label'] = $deviceEdge->label;
                
                $edgesArray[] = $edgeData;
            }
        }
        $finalData = array(
            'nodes' => $nodesArray,
            'edges' => $edgesArray
        );
        return response()->json($finalData);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
